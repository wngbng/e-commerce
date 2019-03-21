<?php

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
//Route::namespace('v1\admin')->group(function () {
//    // 在 "App\Http\Controllers\v1\admin" 命名空间下的控制器
//    Route::get('v1/admin/home','IndexController@Index');
//});
//Route::namespace('v1\home')->group(function () {
//    // 在 "App\Http\Controllers\v1\admin" 命名空间下的控制器
//    Route::get('v1/home/home','IndexController@Index');
//});

//路由前缀为v1/admin的执行"App\Http\Controllers\v1\admin" 命名空间下的控制器
//Route::prefix('v1/admin')->namespace('v1\admin')->group(function(){
//    Route::get('home','IndexController@Index');
//});

//路由前缀为v1/admin的执行"App\Http\Controllers\v1\admin" 命名空间下的控制器
Route::group(['prefix'=>'v1/admin','namespace'=>'v1\admin','middleware'=>'first'],function(){
    Route::get('home','IndexController@Index');
});
