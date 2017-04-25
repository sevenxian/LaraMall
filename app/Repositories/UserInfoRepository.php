<?php

namespace App\Repositories;

use App\Model\UserInfo;

/**
 * Class UserInfoRepository
 * @package App\Repositories
 */
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

    /**
     * 向用户基本表添加一条数据
     *
     * @param array $param
     * @return static
     * @author zhangyuchao
     */
    public function createUserData(array $param)
    {
        return $this->userInfo->create($param);
    }

    /**
     * 根据条件查找单挑数据
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function find(array $where)
    {
        return $this->userInfo->where($where)->first();
    }

    public function updateOneUser(array $where)
    {

    }
}