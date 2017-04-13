<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class AdminUser
 * @package App\Model
 */
class AdminUser extends Authenticatable
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'data_admin_users';

    /**
     * @var array
     */
    protected $dates = ['deleted_at', 'last_login_at'];

    /**
     * @var array
     */
    protected $fillable = ['nickname', 'tel', 'password', 'avatar', 'last_login_ip', 'last_login_at'];

    /**
     * @var array
     */
    protected $hidden = ['password'];

}
