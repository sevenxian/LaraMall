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
}