<?php

/**
 * 32 位 16 进制 Uuid
 *
 * @return string
 * @author: Luoyan
 */
function hexUuid()
{
    $uuid = \Ramsey\Uuid\Uuid::uuid1();

    return $uuid->getHex();
}

if (!function_exists('lang')) {
    /**
     * 获取本地化消息
     *
     * @param string $text
     * @param  array $parameters
     * @return string
     */
    function lang($text, $parameters = [])
    {
        return trans('message.' . $text, $parameters);
    }
}

/**
 * 消息返回
 *
 * @param $message
 * @param int $status
 * @return \Illuminate\Http\JsonResponse
 * @author: Luoyan
 */
function responseMsg($message, $status = 200)
{
    return response()->json([
        'ServerTime' => time(),
        'ServerNo'   => $status,
        'ResultData' => $message
    ]);
}