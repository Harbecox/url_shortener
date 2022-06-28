<?php

namespace App\Http\Controllers;

use App\Models\Alias;
use App\Models\Group;
use App\Models\Url;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as R;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class UrlController extends Controller
{
    function index($alias){
        $url_obj = Alias::query()->where("alias",$alias)->firstOrFail();
        $url = $url_obj['url'];
        if($url_obj->subject_id > 0){
            if($url_obj->type == "group"){
                $group = Group::query()->with(["urls" => function($q){
                    $q->with('alias');
                }])->where("is_active",true)->where("id",$url_obj->subject_id)->firstOrFail();
                $group['urls'] = $group['urls']->map(function ($url){
                    return $url->alias;
                });
                $data['group'] = $group;
                return view("group",$data);
            }elseif($url_obj->type == "url"){
                if($url_obj->url_obj->user->blocked){
                    abort("404");
                }
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
            }
        }
        return redirect($url);
    }
}
