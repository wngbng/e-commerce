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
Route::group(['prefix' => 'v1/admin', 'namespace' => 'admin'], function () {
    Route::get('home', function(){
        var_dump(121212);die;
    });
});
//Route::prefix('v1/admin')->group(function () {
    Route::get('v1/admin/home','IndexController@Index');
//});