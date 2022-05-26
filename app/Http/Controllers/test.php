<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class test extends Controller
{
    function index(Request $request){
        $referer = request()->headers->get('referer');
        $position = Location::get(\Illuminate\Support\Facades\Request::ip());
        $country = "";
        if($position){
            $country = $position->countryCode;
        }
        $agent = new Agent();
        $browser = $agent->browser();
        $os = $agent->platform();
        $device = $agent->deviceType();
    }
}
