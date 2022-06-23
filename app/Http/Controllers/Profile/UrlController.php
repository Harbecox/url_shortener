<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlStoreRequest;
use App\Models\Alias;
use App\Models\Group;
use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UrlController extends Controller
{

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $group_id = $request->get("group_id",-1);
        $date_start = $request->get("date_start",null);
        $date_end = $request->get("date_end",null);
        $order_by = $request->get("order_by");
        $sort = $request->get("sort");

        $sql =  "select groups.title as group_title, urls.*,count(visits.id) as visit,aliases.alias as alias,aliases.url as url".
                " from urls ".
                " JOIN aliases on aliases.subject_id = urls.id and aliases.type = 'url' ".
                " LEFT JOIN visits on visits.alias = aliases.alias ".
                " LEFT JOIN `groups` on `groups`.id = urls.group_id ".
                " WHERE urls.user_id = ".$user_id;

        if($group_id == 0){
            $sql.= " AND urls.group_id is null ";
        }elseif($group_id > 0){
            $sql.= " AND urls.group_id = ".$group_id." ";
        }

        $data['group_id'] = $group_id;
        $data['sort'] = $sort;
        $data['order_by'] = $order_by;

        if($date_start){
            $data['date_start'] = $date_start;
            $sql.= " AND urls.created_at >= '".$date_start."' ";
        }

        if($date_end){
            $data['date_end'] = $date_end;
            $sql.= " AND urls.created_at <= '".$date_end."' ";
        }

        $sql.= " GROUP BY urls.id,aliases.alias,group_title ";
        if($order_by == "visits"){
            $sql.= " order by visit";
        }else{
            $sql.= " order by urls.created_at";
        }

        if($sort == "DESC"){
            $sql.= " DESC ";
        }else{
            $sql.= " ASC ";
        }

        $urls = DB::select(DB::raw($sql));

        $urls = array_map(function ($value) {
            return (array)$value;
        }, $urls);

        $request_query_arr = $request->query();
        unset($request_query_arr['page']);
        $request_query = [];
        foreach ($request_query_arr as $k => $v){
            $request_query[] = $k."=".$v;
        }
        $path = "/".$request->path()."?".implode("&",$request_query);
        $data['urls'] = $this->paginate($urls,25,$request->get("page",1),$path);

        $data['groups'] = Auth::user()->groups;
        return view("profile.url.index",$data);
    }

    public function create()
    {
        $data['groups'] = Auth::user()->groups;
        $data['alias'] = Alias::createUnique();
        $data['method'] = "post";
        $data['action'] = route("dashboard.url.store");
        $data['url'] = new Url();
        return view("profile.url.form",$data);
    }

    public function store(UrlStoreRequest $request)
    {
        $data = $request->validated();
        if(!$data['alias']){
            $data['alias'] = Alias::createUnique();
        }
        if($data['group_id'] == 0){
            $data['group_id'] = null;
        }
        $url_data = [
            "user_id" => Auth::user()->id,
            "group_id" => $data['group_id']
        ];
        $url = Url::create($url_data);
        $alias_data['subject_id'] = $url->id;
        $alias_data['type'] = "url";
        $alias_data['url'] = $data['url'];
        $alias_data['alias'] = $data['alias'];
        Alias::create($alias_data);
        return response()->redirectToRoute("dashboard.url.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($alias)
    {
        $data['url'] = Auth::user()->urls()->where("alias",$alias)->with("url_obj")->firstOrFail();
        $data['url']['group_id'] = $data['url']->url_obj->group_id;
        $data['groups'] = Auth::user()->groups;
        $data['method'] = "put";
        $data['action'] = route("dashboard.url.update",$alias);
        return view("profile.url.form",$data);
    }

    public function update(Request $request,$alias)
    {
        $alias = Auth::user()->urls()->where("alias",$alias)->firstOrFail();
        $alias->url_obj()->update(["group_id" => $request->get("group_id",null)]);
        return response()->redirectToRoute("dashboard.url.index");
    }

    public function destroy($alias)
    {
        $alias = Alias::query()->where("alias",$alias)->firstOrFail();
        $alias->visits()->delete();
        Url::query()->where("id",$alias->subject_id)->delete();
        Alias::query()->where("alias",$alias)->delete();
        return back();
    }

    public function paginate($items, $perPage = 20, $page = null,$path)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $out = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, []);
        $out->setPath($path);
        return $out;
    }

}
