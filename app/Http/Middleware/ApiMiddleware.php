<?php

namespace App\Http\Middleware;

use App\Exceptions\API\ForbiddenException;
use App\Exceptions\API\UnauthorizedException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Guard;

class ApiMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Content-Type','application/json');
        $response->header('Accept','application/json');
        if($request->hasHeader("x-api-token")){
            $token = $request->header("x-api-token");
            $q = User::query()->where("api_token",$token);
            if($q->exists()){
                return $response;
            }
        }
        return throw new UnauthorizedException();
    }
}
