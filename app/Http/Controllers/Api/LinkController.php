<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\API\MethodNotAllowedException;
use App\Http\Requests\API\LinkStoreRequest;
use App\Http\Resources\API\LinkResource;
use App\Models\Alias;
use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends ApiController
{
    function index(Request $request)
    {
        $limit = $request->get("limit", 25);
        $offset = $request->get("offset", 0);
        $group_id = $request->get("group_id", NULL);
        if ($group_id) {
            $count = $this->user->url_objs()->where("group_id", $group_id)->count();
            $links = $this->user->url_objs()->where("group_id", $group_id)->limit($limit)->offset($offset)->get();
        } else {
            $count = $this->user->url_objs()->count();
            $links = $this->user->url_objs()->limit($limit)->offset($offset)->get();
        }
        $response['count'] = intval($count);
        $response['limit'] = intval($limit);
        $response['offset'] = intval($offset);
        $response['links'] = LinkResource::collection($links);
        return $this->response($response);
    }

    function store(LinkStoreRequest $request)
    {
        $data = $request->validated();
        if (!isset($data['alias'])) {
            $data['alias'] = Alias::createUnique();
        }
        if(!isset($data['group_id'])){
            $data['group_id'] = null;
        }
        if ($data['group_id'] == 0) {
            $data['group_id'] = null;
        }
        $url_data = [
            "user_id" => $this->user->id,
            "group_id" => $data['group_id']
        ];
        $url = Url::create($url_data);
        $alias_data['subject_id'] = $url->id;
        $alias_data['type'] = "url";
        $alias_data['url'] = $data['url'];
        $alias_data['alias'] = $data['alias'];
        Alias::create($alias_data);
        return $this->response(
            ["link" => LinkResource::make($url)],
            200,
            'Link successfully created'
        );
    }

    function destroy($alias)
    {
        $alias = Auth::user()->urls()->where("alias",$alias)->firstOrFail();
        Url::query()->where("id",$alias->subject_id)->delete();
        $alias->delete();
        return $this->response(
            [],
            200,
            'Link successfully deleted');
    }

}
