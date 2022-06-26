<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageMetaCreateRequest;
use App\Models\PageMeta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    function index(){
        $data['pages'] = PageMeta::all();
        return view("admin.page.index",$data);
    }

    function create(PageMetaCreateRequest $request){
        $page = new PageMeta();
        $page->page = $request->get("page");
        $page->title = $request->get("title","");
        $page->description = $request->get("description","");
        $page->save();
        return back();
    }

    function delete($id){
        PageMeta::find($id)->delete();
        return back();
    }
}
