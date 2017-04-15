<?php

namespace App\Repositories;


use App\Model\UserInfo;

class UserInfoRepository
{
    /**
     * @var UserInfo
     */
    protected $userInfo;

    /**
     * UserInfoRepository constructor.
     * @param UserInfo $userInfo
     * @author zhangyuchao
     */
    public function __construct(UserInfo $userInfo)
    {
        $this->userInfo = $userInfo;
    }

    public function createUserData(array $param)
    {
        return $this->userInfo->create($param);
    }

    public function find(array $where)
    {

    }

    public function updateOneUser(array $where)
    {

    }
}