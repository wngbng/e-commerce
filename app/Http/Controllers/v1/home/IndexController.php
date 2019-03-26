<?php

namespace App\Http\Controllers\v1\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function __construct()
    {
    }

    public function Index(){
        $array = ['aaa','bbb'];
        return view("home/index",compact($array));
    }
}
