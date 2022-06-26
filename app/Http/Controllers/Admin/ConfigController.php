<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alias;
use App\Models\ApiLimit;
use App\Models\ForbiddenWord;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    function index(){
        $data['words'] = ForbiddenWord::all();
        $data['api_limit'] = ApiLimit::query()->where("id",1)->firstOrCreate();
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
}
