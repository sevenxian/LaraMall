<?php
namespace App\Tools;


class Common
{
    /**
     * 数组转换对象
     *
     * @param $e
     * @return object|void
     * @author zhangyuchao
     */
    public static function arrayToObject($e)
    {

        if (gettype($e) != 'array') return;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object')
                $e[$k] = (object)self::arrayToObject($v);
        }

        return (object)$e;
    }

    /**
     * 对象转换数组
     *
     * @param $e
     * @return array|void
     * @author zhangyuchao
     */
    public static function objectToArray($e)
    {
        $e = (array)$e;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'resource') return;
            if (gettype($v) == 'object' || gettype($v) == 'array')
                $e[$k] = (array)self::objectToArray($v);
        }

        return $e;
    }

    /**
     * 组装操作日志信息
     *
     * @param $operator_id 操作人ID
     * @param $username    操作人用户名
     * @param $ip          操作人客户端IP
     * @param $url         操作的路由
     * @param $param       操作的参数
     * @param $substance   操作的内容
     * @return array
     * @author zhangyuchao
     */
    public static function getLogMessage($operator_id,$username,$ip,$url,$param,$substance)
    {
         return [
            'operator_id' => $operator_id,
            'username'    => $username,
            'time'        => date('Y-m-d,H:i:s',time()),
            'login_ip'    => $ip,
            'url'         => $url,
            'param'       => $param,
            'substance'   => $substance
        ];
    }



}
