<?php

namespace App\Repositories;

use App\Model\UserOperationLog;

/**
 * Class UserLogRepository
 * @package App\Repositories
 */
class UserLogRepository
{
    /**
     * @var UserOperationLog
     */
    protected $userLog;

    /**
     * UserLogRepository constructor.
     * @param UserOperationLog $userOperationLog
     * @author zhangyuchao
     */
    public function __construct(UserOperationLog $userOperationLog)
    {
        $this->userLog = $userOperationLog;
    }

    /**
     * 添加日志到数据库
     *
     * @param array $param
     * @return static
     * @author zhangyuchao
     */
    public function writeLog(array $param)
    {
       return $this->userLog->create($param);
    }

    /**
     *  获取用户操作日志列表
     *
     * @param $where
     * @param int $perPage
     * @author zhangyuchao
     */
    public function userLogList($where,$perPage = 20)
    {
        $this->userLog->where($where)->orderBy('created_at','desc')->paginate($perPage);
    }
}