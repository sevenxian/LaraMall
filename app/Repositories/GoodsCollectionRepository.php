<?php

namespace App\Repositories;


use App\Model\GoodsCollection;

class GoodsCollectionRepository
{
    /**
     * @var GoodsCollection
     */
    protected $goodsCollection;

    /**
     * GoodsCollectionRepository constructor.
     * @param GoodsCollection $goodsCollection
     */
    public function __construct(GoodsCollection $goodsCollection)
    {
        $this->goodsCollection = $goodsCollection;
    }

    /**
     * 添加商品收藏
     *
     * @param array $param
     * @return static
     * @author zhangyuchao
     */
    public function addOneGoodsCollection(array $param)
    {
        return $this->goodsCollection->create($param);
    }

    /**
     * 
     *
     * @param $id
     * @return int
     * @author zhangyuchao
     */
    public function delOneGoodsCollection($id)
    {
        return $this->goodsCollection->destroy($id);
    }
    
    /**
     * 计算货品收藏数量
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function countGoodsCollection(array $where)
    {
        return $this->goodsCollection->where($where)->count();
    }

    /**
     * 查询用户是否收藏该货品
     *
     * @param array $where
     * @return mixed
     * @author zhangyuchao
     */
    public function findUserForGoodsCollection(array $where)
    {
        return $this->goodsCollection->where($where)->first();
    }

    /**
     * 分页获取收藏列表数据
     *
     * @param array $where
     * @param int $perPage
     * @return mixed
     * @author zhangyuchao
     */
    public function getGoodsCollectionList(array $where,$perPage = 10)
    {
       return  $this->goodsCollection->where($where)->paginate($perPage);
    }
}