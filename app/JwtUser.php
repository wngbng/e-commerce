<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;//比User.php多了这个引入，下面并且继承这个接口


class JwtUser extends Authenticatable  implements JWTSubject
{
    protected $table="users";
    // Rest omitted for brevity
    protected $fillable = ['name', 'email','password','phone'];
    protected $hidden = ['password'];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}