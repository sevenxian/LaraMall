<?php

namespace App\Repositories;

use App\Model\IndexUserLogin;

/**
 * Class IndexUserLoginRepository
 * @package App\Repositories
 */
class IndexUserLoginRepository
{
    /**
     * @var IndexUserLogin
     */
    protected $indexUserLogin;

    /**
     * IndexUserLoginRepository constructor.
     * @param IndexUserLogin $indexUserLogin
     * @author zhangyuchao
     */
    public function __construct(IndexUserLogin $indexUserLogin)
    {
        // 用户登录索引表
        $this->indexUserLogin = $indexUserLogin;
    }

    /**
     * 添加一条用户登录方式
     *
     * @param array $param
     * @return static
     * @author zhangyuchao
     */
    public function createOneUserManner(array $param)
    {
        return $this->indexUserLogin->create($param);
    }

    /**
     * 根据条件修改用户登录方式
     *
     * @param array $where
     * @param array $param
     * @return mixed
     * @author zhangyuchao
     */
    public function updateUserManner(array $where, array $param)
    {
        return $this->indexUserLogin->where($where)->update($param);
    }

    /**
     * 根据条件查找用户登录数据
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function findOneUserManner(array $where)
    {
        return $this->indexUserLogin->where($where)->first();
    }
}