<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';

    public function addUser(array $data){
        $this->setRawAttributes($data);
        return $this->save();
    }
}
