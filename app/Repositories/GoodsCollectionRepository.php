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
        return $this->goodsCollection->create();
    }

    /**
     * 删除商品收藏
     *
     * @param $id
     * @return int
     * @author zhangyuchao
     */
    public function delOneGoodsCollection($id)
    {
        return $this->goodsCollection->destroy($id);
    }
}