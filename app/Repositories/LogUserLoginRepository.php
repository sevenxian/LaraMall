<?php

namespace App\Repositories;

use App\Model\LogUserLogin;

/**
 * Class LogUserLoginRepository
 * @package App\Repositories
 */
class LogUserLoginRepository
{
    /**
     * @var LogUserLogin
     */
    protected $logUserLogin;

    /**
     * LogUserLoginRepository constructor.
     * @param LogUserLogin $logUserLogin
     * @author zhangyuchao
     */
    public function __construct(LogUserLogin $logUserLogin)
    {
        $this->logUserLogin = $logUserLogin;
    }

    /**
     * 添加一条用户登录日志
     *
     * @param $param
     * @return static
     * @author zhangyuchao
     */
    public function addOneUserLoginData($param)
    {
        return $this->logUserLogin->create($param);
    }
}