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
    Route::post("mass_delete",[\App\Http\Controllers\Admin\UrlController::class,"mass_delete"])->name("admin.url.mass_delete");
    Route::prefix("users")->group(function (){
        Route::get("/",[\App\Http\Controllers\Admin\UserController::class,"index"])->name("admin.user");
        Route::get("{id}",[\App\Http\Controllers\Admin\UserController::class,"show"])->name("admin.user.show");
        Route::post("{id}",[\App\Http\Controllers\Admin\UserController::class,"update"])->name("admin.user.update");
        Route::delete("/delete/{id}",[\App\Http\Controllers\Admin\UserController::class,"delete"])->name("admin.user.delete");
        Route::get("/block/{id}",[\App\Http\Controllers\Admin\UserController::class,"block"])->name("admin.user.block");
        Route::get("/unblock/{id}",[\App\Http\Controllers\Admin\UserController::class,"unblock"])->name("admin.user.unblock");
    });
    Route::prefix("meta")->group(function (){
        Route::get("/",[\App\Http\Controllers\Admin\MetaController::class,"index"])->name("admin.meta.index");
        Route::post("/",[\App\Http\Controllers\Admin\MetaController::class,"create"])->name("admin.meta.create");
        Route::delete("{id}",[\App\Http\Controllers\Admin\MetaController::class,"delete"])->name("admin.meta.delete");
    });
    Route::prefix("config")->group(function (){
        Route::get("/",[\App\Http\Controllers\Admin\ConfigController::class,'index'])->name("admin.config.index");
        Route::post("/add_word",[\App\Http\Controllers\Admin\ConfigController::class,'add_word'])->name("admin.config.add_word");
        Route::get("/del_word/{id}",[\App\Http\Controllers\Admin\ConfigController::class,'del_word'])->name("admin.config.del_word");
        Route::post("/api_save",[\App\Http\Controllers\Admin\ConfigController::class,"api_save"])->name("admin.config.api_save");
        Route::post("/mass_delete",[\App\Http\Controllers\Admin\ConfigController::class,"mass_delete"])->name("admin.config.mass_delete");
        Route::post("/email_save",[\App\Http\Controllers\Admin\ConfigController::class,"email_save"])->name("admin.config.email");
        Route::post("/change_pass",[\App\Http\Controllers\Admin\ConfigController::class,"change_pass"])->name("admin.config.change_pass");
        Route::post("/check_status",[\App\Http\Controllers\Admin\ConfigController::class,"check_status"])->name("admin.config.check_status");
    });
});

Auth::routes();

Route::post("/",[\App\Http\Controllers\IndexController::class,"create"])->name("create");
Route::get("/",[\App\Http\Controllers\IndexController::class, 'index'])->name("index");
Route::get("policy",[\App\Http\Controllers\IndexController::class, 'policy'])->name("policy");
Route::get("feedback",[\App\Http\Controllers\IndexController::class, 'feedbackForm'])->name("feedback");
Route::post("feedback",[\App\Http\Controllers\IndexController::class, 'sendEmail'])->name("feedback.send");


Route::get('/{alias}',[\App\Http\Controllers\UrlController::class,'index'])->name("url");
