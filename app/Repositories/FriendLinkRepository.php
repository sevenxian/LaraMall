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
     * 根据条件获取单条数据
     *
     * @param array $where
     * @return mixed
     * @author wutao
     */
    public function getOneData(array $where)
    {
        return $this->friendLink->where($where)->first();
    }
    /**
     * 添加友情链接方法
     *
     * @param array $data
     * @return static
     * @author: wutao
     */
    public function createByCategory(array $data)
    {
        return $this->friendLink->create($data);
    }

    /**
     * 根据条件修改单条数据操作
     *
     * @param array $where
     * @param array $params
     * @return mixed
     * @author wutao
     */
    public function updateOneData(array $where ,array $params)
    {
        return $this->friendLink->where($where)->update($params);
    }

    /**
     * 删除数据操作
     *
     * @param $id
     * @return int
     * @author wutao
     */
    public function deleteOneData($id)
    {
        return $this->friendLink->destroy($id);
    }
    /**
     * 获取全部数据
     *
     * @param array $where
     * @param int $perPage
     * @return mixed
     * @author: wutao
     */
    public function getAllData( $perPage = 20)
    {
        return $this->friendLink->paginate($perPage);
    }
    /**
     * 搜索条件分页获取数据
     *
     */
    public function getManyData(array $where , $perPage = 10)
    {
        return $this->friendLink->where($where)->paginate($perPage);
    }
}