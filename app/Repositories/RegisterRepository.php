<?php

namespace App\Repositories;


use App\Model\UserRegister;

class RegisterRepository
{

    /**
     * @var UserRegister
     */
    protected $userRegister;

    /**
     * 注入用户注册model
     *
     * RegisterRepository constructor.
     * @param UserRegister $userRegister
     * @author zhangyuchao
     */
    public function __construct(UserRegister $userRegister)
    {
        $this->userRegister = $userRegister;
    }

    /**
     * 向注册源数据表添加一条数据
     *
     * @param array $param
     * @return static
     * @author zhangyuchao
     */
    public function createOneUser(array $param)
    {
        return $this->userRegister->create($param);
    }

    /**
     * 根据条件查找单挑数据
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function findOneUser(array $where)
    {
        return $this->userRegister->where($where)->first();
    }

}