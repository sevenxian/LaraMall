<?php

namespace App\Repositories;


use App\Model\UsersLogin;

/**
 * Class UsersLoginRepository
 * @package App\Repositories
 */
class UsersLoginRepository
{
    /**
     * @var UsersLogin
     */
    protected $userLogin;

    /**
     * UsersLoginRepository constructor.
     * @param $userLogin
     */
    public function __construct
    (
        UsersLogin $userLogin
    )
    {
        $this->userLogin = $userLogin;
    }
}