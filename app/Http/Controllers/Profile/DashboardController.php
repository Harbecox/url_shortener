<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    function index(){
        $user = Auth::user();
        $urls = $user->urls;

        $urls_aliases = $urls->map(function ($url){
            return $url->alias;
        })->toArray();

        $data = $this->getAliasVisits($urls_aliases);
        $data['urls_count'] = $urls->count();
        $data['url'] = $urls->first();
        $data['is_single'] = false;
        $aliases = Url::query()->where("user_id",Auth::user()->id)->with("alias")->get()
            ->map(function ($url){
                return $url->alias->alias;
            });
        $data['chart_data'] = $this->getChartData($aliases);
        file_put_contents("test.json",json_encode($data));
        exit;
        return view("profile.dashboard",$data);
    }

    function getChartData($aliases){
        $dates = [];
        for($i = 29;$i > -1;$i--){
            $date = Carbon::now()->subDays($i)->format("Y-m-d");
            $dates[$date] = [];
        }
        Visit::query()->whereIn("alias",$aliases)
            ->whereDate("created_at",">",Carbon::now()->subMonth())
            ->get()->map(function ($visit) use (&$dates){
                $date = Carbon::make($visit['created_at'])->startOfDay()->format("Y-m-d");
                $dates[$date][] = $visit;
            });
        foreach ($dates as &$date){
            $date = count($date);
        }
        return $dates;
    }

    function show($alias){
        $user = Auth::user();
        $urls = $user->urls()->where("alias",$alias)->get();

        $urls_aliases = $urls->map(function ($url){
            return $url->alias;
        })->toArray();

        $data = $this->getAliasVisits($urls_aliases);
        $data['urls_count'] = $urls->count();
        $data['url'] = $urls->first();
        $data['is_single'] = true;
        $data['chart_data'] = $this->getChartData([$alias]);
        return view("profile.dashboard",$data);
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
