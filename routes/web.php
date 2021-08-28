<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware" => ["auth", "2fa"]], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(["prefix" => "two_face_auths"], function() {
        Route::get("/", "App\Http\Controllers\TwoFaceAuthsController@index")->name("2fa_setting");
        Route::post("/enable", "App\Http\Controllers\TwoFaceAuthsController@enable")->name("enable_2fa_setting");
        Route::post("/disable", "App\Http\Controllers\TwoFaceAuthsController@disable")->name("disable_2fa_setting");
    });
    Route::group(["prefix" => "role", 'middleware' => 'permission:manage.role'], function() {
        Route::get("/", "App\Http\Controllers\RoleController@index")->name("role_setting");
        Route::get("/{role}/edit", "App\Http\Controllers\RoleController@edit")->name("roles.edit");
        Route::put("/{role}", "App\Http\Controllers\RoleController@update")->name("roles.update");
        Route::get("/create", "App\Http\Controllers\RoleController@create")->name("roles.create");
        Route::post("/store", "App\Http\Controllers\RoleController@store")->name("roles.store");
    });
    Route::group(["prefix" => "permission", 'middleware' => 'permission:manage.permission'], function() {
        Route::get("/", "App\Http\Controllers\PermissionController@index")->name("permission_setting");
        Route::get("/{permission}/edit", "App\Http\Controllers\PermissionController@edit")->name("permission.edit");
        Route::put("/{permission}", "App\Http\Controllers\PermissionController@update")->name("permission.update");
        Route::get("/create", "App\Http\Controllers\PermissionController@create")->name("permission.create");
        Route::post("/store", "App\Http\Controllers\PermissionController@store")->name("permission.store");
        Route::post("/save", "App\Http\Controllers\RolePermissionsController@update")->name("permission.save");
    });
    Route::group(["prefix" => "user", 'middleware' => 'permission:manage.user'], function() {
        Route::get("/", "App\Http\Controllers\UsersController@index")->name("user_setting");
        Route::get("/{id}/edit", "App\Http\Controllers\UsersController@edit")->name("user.edit");
        Route::put("/{id}", "App\Http\Controllers\UsersController@update")->name("user.update");
        Route::get("/create", "App\Http\Controllers\UsersController@create")->name("user.create");
        Route::post("/store", "App\Http\Controllers\UsersController@store")->name("user.store");
    });
});

Route::group(["middleware" => ["auth"], "prefix" => "two_face"], function() {
    Route::get("/", "App\Http\Controllers\VerifyTwoFaceController@index")->name("two_face.index");
    Route::post("/verify", "App\Http\Controllers\VerifyTwoFaceController@verify")->name("two_face.verify");
});
