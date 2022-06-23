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



Route::prefix("dashboard")->middleware(["auth","blocked"])->group(function (){
    Route::get("/",[\App\Http\Controllers\Profile\DashboardController::class,"index"])->name("dashboard");
    Route::resource("url",\App\Http\Controllers\Profile\UrlController::class,['as' => 'dashboard']);
    Route::resource("group",\App\Http\Controllers\Profile\GroupController::class,['as' => 'dashboard']);
    Route::get("api",[\App\Http\Controllers\Profile\ApiController::class,"index"])->name("dashboard.api");
    Route::get("{alias}",[\App\Http\Controllers\Profile\DashboardController::class,"show"])->name("dashboard.show");
});

Route::prefix("admin")->middleware(["auth","admin"])->group(function (){
    Route::get("/",[\App\Http\Controllers\Admin\UrlController::class,"index"])->name("admin.url");
    Route::get("show/{alias}",[\App\Http\Controllers\Admin\UrlController::class,"show"])->name("admin.url.show");
    Route::prefix("users")->group(function (){
        Route::get("/",[\App\Http\Controllers\Admin\UserController::class,"index"])->name("admin.user");
        Route::get("{id}",[\App\Http\Controllers\Admin\UserController::class,"show"])->name("admin.user.show");
        Route::delete("/delete/{id}",[\App\Http\Controllers\Admin\UserController::class,"delete"])->name("admin.user.delete");
        Route::get("/block/{id}",[\App\Http\Controllers\Admin\UserController::class,"block"])->name("admin.user.block");
        Route::get("/unblock/{id}",[\App\Http\Controllers\Admin\UserController::class,"unblock"])->name("admin.user.unblock");
    });
});

Auth::routes();

Route::post("/",[\App\Http\Controllers\IndexController::class,"create"])->name("create");
Route::get("/",[\App\Http\Controllers\IndexController::class, 'index'])->name("index");
Route::get('/{alias}',[\App\Http\Controllers\UrlController::class,'index'])->name("url");
