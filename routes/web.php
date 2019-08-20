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

//Route::namespace('v1\home')->group(function () {
//    // 在 "App\Http\Controllers\v1\home" 命名空间下的控制器
//    Route::get('v1/home','IndexController@Index');
//});

//路由前缀为v1/home的执行"App\Http\Controllers\v1\home" 命名空间下的控制器
//Route::prefix('v1/home')->namespace('v1\home')->group(function(){
//    Route::get('home','IndexController@Index');
//});
Auth::routes();

//登录注册
Route::group(['prefix' => 'jwt'], function () {
    //前台注册
    Route::get('showHomeRegister','JwtController@showHomeRegister');
    Route::post('register','JwtController@registers');

    //前台登录
    Route::get('showHomeLogin','JwtController@showHomeLogin');
    Route::post('login','JwtController@login');

    Route::get('/', ['uses'=>'JwtController@index','middleware'=>'auth:apijwt']);
});
Route::group(['prefix'=>'/','namespace'=>'v1\home'],function() {
    Route::get('/', 'IndexController@Index');
//    Route::get('login', 'IndexController@Index');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
    Route::group(['prefix' => 'home','middleware'=>'jwt.auth'], function () {
        Route::post('user', 'UserController@Index');
    });
});

//路由前缀为v1/home"App\Http\Controllers\v1\home" 命名空间下的控制器
Route::group(['prefix'=>'v1/home','namespace'=>'v1\home','middleware'=>'admin.auth'],function(){
    Route::get('index','IndexController@Index');
});


//Route::get('/home', 'HomeController@index')->name('home');
