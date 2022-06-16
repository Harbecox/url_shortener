<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\API\ForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Middleware\ApiMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    protected $user;
    /**
     * @throws ForbiddenException
     */
    function __construct()
    {
        $this->middleware(ThrottleRequests::class,[1,1]);
        $this->middleware(ApiMiddleware::class);
        $token = \request()->header("x-api-token");
        $ex = User::query()->where("api_token",$token)->exists();
        if(!$ex){
            return throw new ForbiddenException();
        }
        $this->user = User::query()->where("api_token",$token)->first();
        Auth::loginUsingId($this->user->id);
    }

    function response($data,$status = 200,$message = ""){
        $response = [
            "successful" => true,
            "message" => $message
        ];
        $response = array_merge($response,$data);
        return response()->json($response,$status);
    }
}
