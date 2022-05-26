<?php

namespace App\Http\Controllers;

use App\Models\Alias;
use App\Models\Url;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as R;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class UrlController extends Controller
{
    function index($alias){
        $url_obj = Alias::query()->where("alias",$alias)->get()->first();
        $url = $url_obj['url'];
        $ip = R::ip();
        $is_unique = !Visit::query()->where("alias",$alias)
            ->where("ip",$ip)->exists();
        if($is_unique){
            $referer = R::header("referer");
            $position = Location::get($ip);
            $country_code = "";
            if($position){
                $country_code = $position->countryCode;
            }
            $agent = new Agent();
            $browser = $agent->browser();
            $os = $agent->platform();
            $device = $agent->deviceType();
            Visit::create([
                "alias" => $alias,
                "country_code" => $country_code,
                "ip" => $ip,
                "referer" => $referer,
                "browser" => $browser,
                "os" => $os,
                "device" => $device
            ]);
        }
        return redirect($url);
    }
}
