<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GroupStoreRequest;
use App\Http\Resources\API\GroupResource;

use App\Models\Alias;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends ApiController
{
    function index(Request $request){
        $limit = $request->get("limit", 25);
        $offset = $request->get("offset", 0);

        $query = Auth::user()->groups();
        $groups = $query->limit($limit)->offset($offset)->get();
        $response['count'] = intval($query->count());
        $response['limit'] = intval($limit);
        $response['offset'] = intval($offset);
        $response['groups'] = GroupResource::collection($groups);
        return $this->response($response);
    }

    function store(GroupStoreRequest $request){
        $group_data = [
            "title" => $request->get("title"),
            "description" => $request->get("description"),
            "is_active" => $request->get("is_active",true),
            "is_rotation" => $request->get("is_active",false),
        ];
        $group = Auth::user()->groups()->create($group_data);
        $alias_data = [
            "alias" => $request->get("alias",Alias::createUnique()),
            "type" => "group",
            "subject_id" => $group->id
        ];
        Alias::create($alias_data);
        return $this->response([
            "group" => GroupResource::make($group),
        ],200,"Group created");
    }

    function destroy($id){
        $group = Auth::user()->groups()->where("id",$id)->firstOrFail();
        $alias = Alias::query()->where("type","group")->where("subject_id",$group->id);
        if($alias->exists()){
            $alias->delete();
        }
        $group->delete();
        return $this->response([],200,"Group removed");
    }

}
