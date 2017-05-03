<?php

namespace App\Repositories;

use App\Model\AdminUser;

class AdminUserRepository
{
    /**
     * @var AdminUser
     */
    protected $adminUser;

    /**
     * AdminUserRepository constructor.
     * @param AdminUser $adminUser
     * @author zhangyuchao
     */
    public function __construct(AdminUser $adminUser)
    {
        $this->adminUser = $adminUser;
    }

    /**
     *  添加用户方法
     *
     * @param array $data
     * @return static
     * @author zhangyuchao
     */
    public function createByUser(array $data)
    {
        return  $this->adminUser->create($data);
    }

    /**
     * 分页获取管理员数据
     *
     * @param array $where
     * @param int $perPage
     * @return mixed
     * @author zhangyuchao
     */
    public function getAllData(array $where, $perPage = 20)
    {
        // 按照管理员登录的时间老获取数据
        return $this->adminUser->where($where)->orderBy('last_login_at', 'desc')->paginate($perPage);
    }

    /**
     * 根据条件获取单条数据
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function getOneData(array $where)
    {
        return $this->adminUser->where($where)->first();
    }

    /**
     * 根据条件获取总数
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function getUserCount(array $where)
    {
        return $this->adminUser->where($where)->count();

    }

    /**
     * 根据条件修改单挑数据
     *
     * @param array $where
     * @param array $params
     * @return mixed
     * @author zhangyuchao
     */
    public function updateOneData(array $where, array $params)
    {
        return $this->adminUser->where($where)->update($params);
    }

    /**
     * 删除数据操作
     *
     * @param $id
     * @return int
     * @author zhangyuchao
     */
    public function deleteOneData($id)
    {
        return $this->adminUser->destroy($id);
    }

    /**
     * 获取角色所拥有权限的 id
     *
     * @param $id
     * @return mixed
     * @author: Luoyan
     */
    public function fetchRolesTheIds($id)
    {
        return $this->adminUser->where('id', $id)->first()->roles()->pluck('id');
    }
}