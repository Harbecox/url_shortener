<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alias;
use App\Models\ApiLimit;
use App\Models\CheckUrlOkStatus;
use App\Models\FeedbackEmail;
use App\Models\ForbiddenWord;
use App\Models\Url;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    function index(){
        $data['words'] = ForbiddenWord::all();
        $data['api_limit'] = ApiLimit::query()->where("id",1)->firstOrCreate();
        $data['feedback_email'] = FeedbackEmail::query()->firstOrFail()->email;
        $data['check_status'] = CheckUrlOkStatus::query()->firstOrFail()->check;
        return view("admin.config.index",$data);
    }

    function add_word(Request $request){
        $word = $request->get("word");
        $FB = new ForbiddenWord();
        $FB->word = $word;
        $FB->save();
        return back();
    }

    function del_word($del_word){
        ForbiddenWord::query()->where("id",$del_word)->delete();
        return back();
    }

    function api_save(Request $request){
        $AL = ApiLimit::query()->where("id",1)->firstOrCreate();
        $AL->date_type = $request->get("date_type");
        $AL->requests = $request->get("requests");
        $AL->save();
        return back();
    }

    function mass_delete(Request $request){
        $from = Carbon::make($request->get("after"));
        Url::query()->where("created_at","<",$from)->delete();
        Alias::query()->where("created_at","<",$from)->delete();
        return back();
    }

    function email_save(Request $request){
        $fm = FeedbackEmail::query()->firstOrFail();
        $fm->email = $request->email;
        $fm->save();
        return back()->with("success","Email saved");
    }

    function change_pass(Request $request){
        if($request->get("password") == $request->get("re_password")){
            $user = Auth::user();
            $user = User::find($user->id);
            $user->password = $request->get("password");
            $user->save();
        }
        return back()->with("success","Password saved");
    }

    function check_status(Request $request){

        $check = CheckUrlOkStatus::query()->firstOrFail();
        $check->check = $request->has("check");
        $check->save();
        return back()->with("success","Saved");
    }
}
