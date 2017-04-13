<?php

namespace App\Repositories;
use App\Model\FriendLink;


/**
 * Class FriendLinkRepository
 * @package App\Repositories
 */
class FriendLinkRepository
{
    /**
     * @var FriendLink
     */
    protected $friendLink;

    /**
     * FriendLinkRepository constructor.
     * @param FriendLink $friendLink
     */
    public function __construct(FriendLink $friendLink)
    {
        $this->friendLink = $friendLink;
    }
    /**
     * 添加用户方法
     *
     * @param array $data
     * @return static
     * @author: wutao
     */
    public function createByUser(array $data)
    {
        return $this->friendLink->create($data);
    }

    /**
     * 删除数据操作
     *
     * @param $id
     * @return int
     * @author zhangyuchao
     */

}