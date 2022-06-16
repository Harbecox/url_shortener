<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupStoreRequest;
use App\Models\Alias;
use App\Models\Group;
use App\Models\Url;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['groups'] = Auth::user()->groups()->with("alias")->get();
        return view("profile.group.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['group'] = new Group();
        $data['action'] = route("dashboard.group.store");
        $data['method'] = "post";
        $data['alias'] = Alias::createUnique();
        return view("profile.group.form",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupStoreRequest $request)
    {
        $alias = $request->get("alias",Alias::createUnique());
        $data["title"] = $request->get("title");
        $data['is_active'] = $request->has("is_active");
        $data['is_rotation'] = $request->has("is_rotation");
        $data['description'] = $request->get("description",null);
        $group = Auth::user()->groups()->create($data);
        $group->alias()->create(["alias" => $alias,"type" => "group"]);
        return response()->redirectToRoute("dashboard.group.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $data['group'] = $group;
        $data['action'] = route("dashboard.group.update",$group->id);
        $data['method'] = "put";
        return view("profile.group.form",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Auth::user()->groups()->where("id",$id)->first();
        $alias = $request->get("alias");
        if($alias != $group->alias->alias){
            if(Alias::isUnique($alias)){
                $group->alias()->update(['alias' => $alias]);
            }
        }
        $data["title"] = $request->get("title");
        $data['is_active'] = $request->get("is_active",false);
        $data['is_rotation'] = $request->get("is_rotation",false);
        $data['description'] = $request->get("description",null);
        $group->update($data);
        return response()->redirectToRoute("dashboard.group.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->urls->map(function ($url){
            $url->group_id = null;
            $url->save();
        });
        $group->delete();
        return response()->redirectToRoute("dashboard.group.index");
    }
}
