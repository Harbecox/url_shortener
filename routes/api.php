<?php

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


Route::prefix("links")->group(function (){
    Route::get("/",[\App\Http\Controllers\Api\LinkController::class,"index"]);
    Route::post("/",[\App\Http\Controllers\Api\LinkController::class,"store"]);
    Route::delete("{alias}",[\App\Http\Controllers\Api\LinkController::class,"index"]);
});

Route::resource("groups", \App\Http\Controllers\Api\GroupController::class);

