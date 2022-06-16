<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\API\MethodNotAllowedException;
use App\Http\Requests\API\LinkStoreRequest;
use App\Http\Resources\API\LinkResource;
use App\Models\Alias;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends ApiController
{
    function index(Request $request)
    {
        $limit = $request->get("limit", 25);
        $offset = $request->get("offset", 0);
        $group_id = $request->get("group_id", NULL);
        $count = 0;
        if ($group_id) {
            $count = $this->user->url_objs()->where("group_id", $group_id)->count();
            $links = $this->user->url_objs()->where("group_id", $group_id)->limit($limit)->offset($offset)->get();
        } else {
            $count = $this->user->url_objs()->count();
            $links = $this->user->url_objs()->limit($limit)->offset($offset)->get();
        }
        $response['count'] = $count;
        $response['limit'] = $limit;
        $response['offset'] = $offset;
        $response['links'] = LinkResource::collection($links);
        return $this->response($response);
    }

    function store(LinkStoreRequest $request)
    {
        $data = $request->validated();
        if (!$data['alias']) {
            $data['alias'] = Alias::createUnique();
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

    }

}
