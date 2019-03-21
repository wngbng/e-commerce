<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\First as Middleware;

class First extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    public function __construct()
    {
        var_dump(11221123);die;
    }
}
