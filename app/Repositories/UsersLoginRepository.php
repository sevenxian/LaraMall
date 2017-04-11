<?php

namespace App\Repositories;


use App\Model\AdminUser;

/**
 * Class UsersLoginRepository
 * @package App\Repositories
 */
class UsersLoginRepository
{
    /**
     * @var AdminUser
     */
    protected $adminUser;

    /**
     * UsersLoginRepository constructor.
     * @param $adminUser
     */
    public function __construct(AdminUser $adminUser)
    {
        $this->adminUser = $adminUser;
    }

    /**
     * 添加用户
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