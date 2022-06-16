<?php

use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Location;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::prefix("dashboard")->middleware("auth")->group(function (){
    Route::get("/",[\App\Http\Controllers\Profile\DashboardController::class,"index"])->name("dashboard");
    Route::resource("url",\App\Http\Controllers\Profile\UrlController::class,['as' => 'dashboard']);
    Route::resource("group",\App\Http\Controllers\Profile\GroupController::class,['as' => 'dashboard']);
    Route::get("api",[\App\Http\Controllers\Profile\ApiController::class,"index"])->name("dashboard.api");
    Route::get("{alias}",[\App\Http\Controllers\Profile\DashboardController::class,"show"])->name("dashboard.show");
});

Auth::routes();

Route::get('/{alias}',[\App\Http\Controllers\UrlController::class,'index'])->name("url");
