<?php

use App\Models\ApiLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

\Illuminate\Support\Facades\RateLimiter::for('api',function (Request $request){
    $AL = ApiLimit::query()->where("id",1)->firstOrCreate();
    if($AL->date_type == "minute"){
        return \Illuminate\Cache\RateLimiting\Limit::perMinute($AL->requests);
    }
    if($AL->date_type == "hour"){
        return \Illuminate\Cache\RateLimiting\Limit::perHour($AL->requests);
    }
    if($AL->date_type == "day"){
        return \Illuminate\Cache\RateLimiting\Limit::perDay($AL->requests);
    }
    if($AL->date_type == "month"){
        return \Illuminate\Cache\RateLimiting\Limit::perDay($AL->requests * 30);
    }
});

Route::middleware("throttle:testing")->group(function (){
    Route::prefix("links")->group(function (){
        Route::get("/",[\App\Http\Controllers\Api\LinkController::class,"index"]);
        Route::post("/",[\App\Http\Controllers\Api\LinkController::class,"store"]);
        Route::delete("{alias}",[\App\Http\Controllers\Api\LinkController::class,"destroy"]);
    });

    Route::prefix("groups")->group(function (){
        Route::get("/",[\App\Http\Controllers\Api\GroupController::class,"index"]);
        Route::post("/",[\App\Http\Controllers\Api\GroupController::class,"store"]);
        Route::delete("{id}",[\App\Http\Controllers\Api\GroupController::class,"destroy"]);
    });
});


