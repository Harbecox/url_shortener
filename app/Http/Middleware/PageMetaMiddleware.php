<?php

namespace App\Http\Middleware;

use App\Models\PageMeta;
use Closure;
use Illuminate\Http\Request;

class PageMetaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $page = $request->path();
        $query = PageMeta::query()->where("page",$page);
        if($query->exists()){
            $meta = $query->first();
            $request['meta'] = $meta;
        }
        return $next($request);
    }
}
