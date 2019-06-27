<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //默认数据表
    protected $table = 'users';

    /**
     * 查询用户单条数据
     * @param $where
     * @return mixed
     */
    public function getUserInfo($where){
        return $this->where($where)->first();
    }
    /**
     * 修改用户数据
     * @param array $where
     * @param array $data
     * @return mixed
     */
    public function editUser(array $where,array $data){
        return $this->where($where)->update($data);
    }
}
