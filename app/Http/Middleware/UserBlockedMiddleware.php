<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBlockedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return response()->redirectToRoute("login");
        }
        return Auth::user()->blocked ? route("login") : $next($request);
    }
}
