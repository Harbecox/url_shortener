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
        if(Auth::user()->blocked){
            Auth::guard()->logout();
            return response()->redirectToRoute("login")->with("warning" ,__("auth.block"));
        }
        return $next($request);
    }
}
