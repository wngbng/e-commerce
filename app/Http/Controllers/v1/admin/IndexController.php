<?php

namespace App\Http\Controllers\v1\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        echo 'admin';
    }

    public function Index(){
        echo 'admin';
        die;
    }
    //
}
