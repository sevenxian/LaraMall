<?php

namespace App\Repositories;


use App\Model\Permission;

/**
 * Class RoleRepository
 * @package App\Repositories
 */
class PermissionRepository
{

    /**
     * @var Permission
     * @author Luoyan
     */
    protected $permission;

    /**
     * RoleRepository constructor.
     * @param Permission $permission
     * @author Luoyan
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }


    /**
     * 创建权限
     *
     * @param array $data
     * @return static
     * @author: Luoyan
     */
    public function createRole(array $data)
    {
        return $this->permission->create($data);
    }

    /**
     * 获取所有权限
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author: Luoyan
     */
    public function fetchPermissions()
    {
        return $this->permission->all();
    }
}