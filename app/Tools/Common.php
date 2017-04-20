<?php

namespace App\Tools;


use Naux\Mail\SendCloudTemplate;

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
     * 处于登录状态下的操作日志信息拼装
     *
     * @param int $operator_id
     * @param string $substance
     * @return array
     * @author zhangyuchao
     */
    public static function logMessageForInside($operator_id = 0, $substance = '')
    {
        return [
            'operator_id' => $operator_id,
            'time'        => date('Y-m-d,H:i:s', time()),
            'login_ip'    => request()->ip(),
            'url'         => request()->url(),
            'param'       => request()->all(),
            'content'     => $substance
        ];
    }

    /**
     * 处于未登录状态下的操作日志信息拼装
     *
     * @param string $ip
     * @param string $url
     * @param array $param
     * @param string $substance
     * @return array
     * @author zhangyuchao
     */
    public static function logMessageForOutside($ip = '', $url = '', array $param, $substance = '')
    {
        return [
            'time'     => date('Y-m-d,H:i:s', time()),
            'login_ip' => $ip,
            'url'      => $url,
            'param'    => $param,
            'content'  => $substance
        ];
    }

    /**
     * 邮件发送
     *
     * @param $templateName
     * @param $title
     * @param $recipients
     * @param array $data
     * @return bool
     * @author zhangyuchao
     */
    public static function sendEmail($templateName, $title, $recipients, array $data)
    {
        // 邮件发送
        $flag = \Mail::send('email.' . $templateName, $data, function ($message) use ($recipients, $title) {

            $message->to($recipients)->subject($title);
        });

        // 判断发送结果
        return true;
    }
}
