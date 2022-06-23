<?php

namespace App\Http\Controllers;


use App\Models\Alias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    function index(){
        $urls = Cookie::get("urls","[]");
        $urls = json_decode($urls,true);
        $data['urls'] = $urls;
        return view("index",$data);
    }

    function create(Request $request){
        $urls = json_decode(Cookie::get("urls","[]"),true);
        $alias = new Alias();
        $alias['alias'] = Alias::createUnique();
        $alias['url'] = $request->get("url");
        $alias['type'] = "url";
        $alias['subject_id'] = 0;
        $alias->save();
        $url = [
            "alias" => $alias['alias'],
            "url" => $alias['url']
        ];
        $urls[] = $url;
        Cookie::queue("urls",json_encode($urls));
        return back();
    }
}
