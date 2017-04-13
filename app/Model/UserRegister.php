<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRegister
 * @package App\Model
 */
class UserRegister extends Model
{

    /**
     * 用户原始表 不可删除 不可修改
     * @var string
     */
    protected $table = 'data_users_register';

    /**
     * @var array
     */
    protected $fillable = ['register_name', 'password', 'third_party_id', 'register_ip'];

    /**
     * @var array
     */
    protected $hidden = ['password'];
}
