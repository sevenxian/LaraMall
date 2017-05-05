<?php

namespace App\Repositories;

use App\Model\UserRegister;

/**
 * Class RegisterRepository
 * @package App\Repositories
 */
class RegisterRepository
{
    use BaseRepository;
    /**
     * @var UserRegister
     */
    protected $model;

    /**
     * 注入用户注册model
     *
     * RegisterRepository constructor.
     * @param UserRegister $userRegister
     * @author zhangyuchao
     */
    public function __construct(UserRegister $userRegister)
    {
        $this->model = $userRegister;
    }



}