<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alias;
use App\Models\Group;
use App\Models\Url;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        $users = User::query()
            ->where("role","user")
            ->paginate(25);

        $user_ids = [];
        foreach ($users as $user){
            $user_ids[] = $user->id;
        }

        $urls = Url::query()
            ->whereIn("user_id",$user_ids)
            ->with("alias")
            ->get();

        $aliases = $urls->map(function ($url){
            return $url->alias->alias;
        })->toArray();

        $visits = Visit::query()->selectRaw("count(alias) as visits,alias")->whereIn("alias",$aliases)->groupBy("alias")->get()->keyBy("alias")->toArray();


        $urls = $urls->map(function (Url $url) use ($visits){
            $alias = $url->alias;
            $url->unsetRelation("alias");
            $url["alias"] = $alias->alias;
            $url["visits"] = $visits[$alias->alias]['visits'];
            return $url;
        })->groupBy("user_id");

        foreach ($users as &$user){
            $visits_count = 0;
            $url_count = 0;
            foreach ($urls[$user->id] as $url){
                $url_count++;
                $visits_count += $url->visits;
            }
            $user['urls'] = [
                "url_count" => $url_count,
                "visits_count" => $visits_count
            ];
        }

        $data['users'] = $users;
        return view("admin.users.index",$data);
    }

    function show($id){
        $user = User::find($id);
        $urls = $user->urls;

        $urls_aliases = $urls->map(function ($url){
            return $url->alias;
        })->toArray();

        $data = $this->getAliasVisits($urls_aliases);
        $data['urls_count'] = $urls->count();
        $data['url'] = $urls->first();
        $data['is_single'] = false;
        $data['user'] = $user;
        return view("admin.users.show",$data);
    }

    function block($id){
        $user = User::find($id);
        $user->blocked = true;
        $user->save();
        return back();
    }

    function unblock($id){
        $user = User::find($id);
        $user->blocked = false;
        $user->save();
        return back();
    }

    function delete($id){
        $user = User::find($id);
        $user->groups()->delete();
        $aliases = $user->urls->map(function ($alias){
            return $alias->alias;
        });
        Visit::query()->whereIn("alias",$aliases)->delete();
        Alias::query()->whereIn("alias",$aliases)->delete();
        $user->url_objs()->delete();
        $user->delete();
        return back();
    }

    function getAliasVisits($urls_aliases){
        $visits = Visit::query()->whereIn("alias",$urls_aliases)->get()->map(function ($visit){
            $url = $visit->referer;
            $part = explode("/",$url);
            if(count($part) > 2){
                $visit->referer = str_replace("www.","",$part[2]);
            }
            return $visit;
        });

        $data['visits_count'] = $visits->count();
        $data['visits_today'] = $visits->where("created_at",">",Carbon::now()->startOfDay())->count();
        $data['visits_month'] = $visits->where("created_at",">",Carbon::now()->startOfMonth())->count();

        $data['devices'] = $visits->groupBy("device")->map(function ($device){
            return $device->count();
        });

        $data['browser'] = $visits->groupBy("browser")->map(function ($browser){
            return $browser->count();
        });

        $data['os'] = $visits->groupBy("os")->map(function ($os){
            return $os->count();
        });

        $data['referer'] = $visits->groupBy("referer")->map(function ($referer){
            return $referer->count();
        });

        $countries_json = file_get_contents("dist/countries.json");
        $countries = json_decode($countries_json,true);

        $visits->groupBy("country_code")->each(function ($country,$code) use (&$countries){
            $code = strtolower($code);
            if(isset($countries[$code])){
                $countries[$code]['name'] = $countries[$code]['name'].":".$country->count();
                $countries[$code]['count'] = $country->count();
            }
        });

        $data['countries'] = $countries;

        return $data;
    }
}