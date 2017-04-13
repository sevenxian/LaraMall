<?php

namespace App\Repositories;
use App\Model\AdminUser;


/**
 * Class AdminUserRepository
 * @package App\Repositories
 */
class AdminUserRepository
{
    /**
     * @var AdminUser
     */
    protected $adminUser;

    /**
     * AdminUserRepository constructor.
     * @param AdminUser $adminUser
     */
    public function __construct(AdminUser $adminUser)
    {
        $this->adminUser = $adminUser;
    }
    /**
     * 添加用户方法
     *
     * @param array $data
     * @return static
     * @author: Luoyan
     */
    public function createByUser(array $data)
    {
        return $this->adminUser->create($data);
    }

    /**
     * 分页获取管理员数据
     *
     * @param array $where
     * @param int $perPage
     * @return bool
     * @author zhangyuchao
     */
    public function getAllData($where = [] , $perPage = 20)
    {
        // 按照管理员登录的时间老获取数据
        $data = $this->adminUser->where($where)->orderBy('last_login_at','desc')->paginate($perPage);
        if(empty($data)) return false;
        return $data;
    }


    /**
     * 根据条件获取单条数据
     *
     * @param array $where
     * @return bool
     * @author zhangyuchao
     */
    public function getOneData($where = [])
    {
        // 条件不可以为空
        if(empty($where)) return false;
        $data = $this->adminUser->where($where)->first();
        return $data;
    }

    /**
     * 根据条件计算总条数
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function getUserCount($where = [])
    {
        // 根据条件计算数据总条数
        $count = $this->adminUser->where($where)->count();
        return $count;
    }

    /**
     * 根据条件修改单挑数据
     *
     * @param array $where
     * @param array $params
     * @return bool
     * @author zhangyuchao
     */
    public function updateOneData($where = [] ,$params = [])
    {
        // 条件 和 参数 不能为空
        if(empty($where) || empty($params)) return false;
        // 修改数据
        return  $this->adminUser->where($where)->update($params);
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
}