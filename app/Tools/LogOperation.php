<?php

namespace App\Tools;

use App\Repositories\AdminLogRepository;
use App\Repositories\UserLogRepository;
use Illuminate\Log\Writer;
use Monolog\Logger;

class LogOperation
{
    /**
     * @var AdminLogRepository
     */
    protected  $adminLog;

    /**
     * @var UserLogRepository
     */
    protected  $userLog;

    /**
     * 注入写入日志需要的文件(前台用户和管理员操作)
     *
     * LogOperation constructor.
     * @param AdminLogRepository $adminOperationLog
     * @param UserLogRepository $userLogRepository
     * @author zhangyuchao
     */
    public function __construct(AdminLogRepository $adminOperationLog,UserLogRepository $userLogRepository)
    {
        $this->adminLog = $adminOperationLog;
        $this->userLog  = $userLogRepository;
    }

    /**
     * 写入后台管理员操作日志
     *
     * @param array $message
     * @param bool $logType  false 保存到文件 true 保存到数据库
     * @author zhangyuchao
     */
    public function writeAdminLog(array $message,$logType = false)
    {
        // 拼接记录日志需要的内容
        $message['content'] = $this->prompt($message);
        $event = $message['param'];
        $event['url'] = $message['url'];
        // 选择日志类型
        if($logType){
            // 数据库的event字段为json类型
            $message['events'] = json_encode($event);
            // 操作日志保存到数据库
            $result = $this->adminWriteForDB($message);
            // 操作日志保存数据库失败,到文件
            if(empty($result)) $this->adminWriteForFile($message['content'],$event,true);
        }else{
            // 保存到log日志
            $this->adminWriteForFile($message['content'],$event);
        }
    }

    /**
     * 操作日志保存到数据库
     *
     * @param $param
     * @return static
     * @author zhangyuchao
     */
    private function adminWriteForDB($param)
    {
        return $this->adminLog->writeLog($param);
    }

    /**
     * 文件记录管理员日志操作
     *
     * @param $record
     * @param array $param
     * @param bool $again
     * @author zhangyuchao
     */
    private function adminWriteForFile($record,array $param, $again = false)
    {
        // 添加"-----"是为了查询日志更方便
        if($again){
            $record = '数据库填写日志失败，改写为log日志'.$record;
        }
        $this->log('admin.log',$record,$param);
    }

    /**
     * 拼接操作日志内容
     *
     * @param array $message
     * @return string
     * @author zhangyuchao
     */
    private function prompt(array $message)
    {
       return 'adminID为'.$message['operator_id'].',用户名为'.$message['username'].'的用户,在'.$message['time'].'进行'.$message['substance'].',IP地址为'.$message['login_ip'].':';
    }

    /**
     * 根据操作存放不同的log文件
     *
     * @param $logName
     * @param $record
     * @param $param
     * @author zhangyuchao
     */
    private function log($logName,$record,$param)
    {
        $log = new Writer(new Logger('signin'));
        $log->useDailyFiles(storage_path().'/logs/'.$logName,45);
        $log->write('info',$record,$param);
    }

}