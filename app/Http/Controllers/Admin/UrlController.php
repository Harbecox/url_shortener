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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    function index(Request $request){
        $user_id = $request->get("user_id",0);
        $group_id = $request->get("group_id",null);
        $date_start = $request->get("date_start",Carbon::now()->subDays(30));
        $date_end = $request->get("date_end",Carbon::now());

        $query = Url::query();

        if($user_id > 0){
            $query = $query->where("user_id",$user_id);
        }
        if($group_id){
            $query = $query->where("group_id",$group_id);
        }
        if($date_start){
            $query = $query->whereDate("created_at",">=",$date_start);
        }
        if($date_end){
            $query = $query->whereDate("created_at","<=",$date_end);
        }

        $urls = $query->paginate(25)->withQueryString();

        $ids = [];
        $user_ids = [];
        $group_ids = [];
        foreach ($urls as $url){
            $ids[] = $url->id;
            $user_ids[] = $url->user_id;
            $group_ids[] = $url->group_id;
        }

        $aliases_q = Alias::query()->whereIn("subject_id",$ids)->where("type","url")->get();

        $aliases = $aliases_q->map(function ($a){
            return $a->alias;
        });

        $visits = Visit::query()->whereIn("alias",$aliases)->get()->groupBy("alias")
            ->map(function ($items){
                return $items->count();
            });

        $users = User::query()->whereIn("id",$user_ids)->get();
        $groups = Group::query()->whereIn("id",$group_ids)->get();

        foreach ($urls as &$url){
            $alias = $aliases_q->where("subject_id",$url->id)->first()->alias;
            $url['alias'] = $alias;
            $url['url'] = $aliases_q->where("subject_id",$url->id)->first()->url;
            $url['visits'] = $visits[$alias];
            $url['user'] = $users->where("id",$url->user_id)->first();
            $url['group'] = $groups->where("id",$url->group_id)->first();
        }

        $data['user_id'] = $user_id;
        $data['urls'] = $urls;
        $data['users'] = User::query()->where("role","user")->select(['name','email','id'])->get();
        $data['date_start'] = Carbon::make($date_start)->toDateString();
        $data['date_end'] = Carbon::make($date_end)->toDateString();

        return view("admin.url.index",$data);
    }

    function show($alias){
        $urls = Alias::query()->where("alias",$alias)->get();

        $urls_aliases = $urls->map(function ($url){
            return $url->alias;
        })->toArray();

        $data = $this->getAliasVisits($urls_aliases);
        $data['urls_count'] = $urls->count();
        $data['url'] = $urls->first();
        $data['is_single'] = true;
        return view("admin.url.show",$data);
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
