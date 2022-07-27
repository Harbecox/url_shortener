<?php

namespace App\Http\Controllers;


use App\Http\Requests\EmailRequest;
use App\Http\Requests\UrlGurstRequest;
use App\Mail\Feedback;
use App\Models\Alias;
use App\Models\FeedbackEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    function index(){
        $urls = Cookie::get("urls","[]");
        $urls = json_decode($urls,true);
        $data['urls'] = $urls;
        return view("index",$data);
    }

    function create(UrlGurstRequest $request){
        $urls = json_decode(Cookie::get("urls","[]"),true);
        $exists = collect($urls)->where("url",$request->get("url"))->count() > 0;
        if($exists){
            return back()->with("error","Ссылка не валидна, запрещена или повторяется");
        }
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

    function feedbackForm(){
        return view("feedback");
    }

    function sendEmail(EmailRequest $request){

        Mail::to(FeedbackEmail::query()->firstOrFail()->email)
            ->send(new Feedback($request->all()));
        return back()->with("success","Ваше письмо отправлено");
    }

    function policy(){
        return view("policy");
    }
}
