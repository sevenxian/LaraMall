<?php

namespace App\Repositories;


use App\Model\Role;

/**
 * Class RoleRepository
 * @package App\Repositories
 */
class RoleRepository
{
    /**
     * @var Role
     * @author Luoyan
     */
    protected $role;

    /**
     * 模型注入
     *
     * RoleRepository constructor.
     * @param $role
     * @author Luoyan
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * 创建角色
     *
     * @param array $data
     * @return static
     * @author: Luoyan
     */
    public function createRole(array $data)
    {
        return $this->role->create($data);
    }

    /**
     * 分类搜索分页
     *
     * @param int $perPage
     * @param array $where
     * @return mixed
     * @author: Luoyan
     */
    public function aclPaginate($perPage = 10, array $where = [])
    {
        return $this->role->where($where)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * 根据 id 修改信息
     *
     * @param $id
     * @param array $data
     * @return mixed
     * @author: Luoyan
     */
    public function updateById($id, array $data)
    {
        return $this->role->where('id', $id)->update($data);
    }

    /**
     * 根据 id 查询一条数据
     *
     * @param $id
     * @return mixed
     * @author: Luoyan
     */
    public function findById($id)
    {
        return $this->role->find($id);
    }

    /**
     * 获取角色所拥有权限的 id
     *
     * @param $id
     * @return mixed
     * @author: Luoyan
     */
    public function fetchPermissionsTheIds($id)
    {
        return $this->role->where('id', $id)->first()->permissions()->pluck('id');
    }
}