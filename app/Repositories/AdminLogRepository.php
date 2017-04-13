<?php

namespace App\Repositories;


use App\Model\AdminOperationLog;

class AdminLogRepository
{
    /**
     * @var AdminOperationLog
     */
    protected $adminOperationLog;

    /**
     * 注入管理员操作日志的模型
     *
     * AdminLogRepository constructor.
     * @param AdminOperationLog $adminLog
     * @author zhangyuchao
     */
    public function __construct(AdminOperationLog $adminLog)
    {
        $this->adminOperationLog = $adminLog;
    }

    /**
     * 保存日志到数据库
     *
     * @param array $param
     * @return static
     * @author zhangyuchao
     */
    public function writeLog(array $param)
    {
       return  $this->adminOperationLog->create($param);
    }

    /**
     * 获取日志列表
     *
     * @param array $where
     * @param int $perPage
     * @author zhangyuchao
     */
    public function adminLogList(array $where, $perPage = 20)
    {
        return $this->adminOperationLog->where($where)->orderBy('created_at','desc')->paginate($perPage);
    }
}