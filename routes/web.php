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
prefix('admin')->group(function () {

});
Route::group(['prefix' => '/v1/admin', 'namespace' => 'admin'], function () {
    Route::get('admin/home', function(){
        var_dump(121212);die;
    });
});