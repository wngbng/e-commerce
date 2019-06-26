<?php

namespace App\Http\Controllers\v1\home;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexController extends  HomeController
{
    //
    public function __construct()
    {
        parent::__construct();
        // Facade
//        $token = JWTAuth::parseToken()->getToken();

    }

    public function Index(){
        $array = ['aaa','bbb'];
        return view("home/index",compact($array));
    }
}
