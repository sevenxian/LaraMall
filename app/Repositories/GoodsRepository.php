<?php

namespace App\Repositories;

use App\Model\Goods;

/**
 * Class GoodsRepository
 * @package App\Repositories
 */
class GoodsRepository
{
    /**
     * @var
     */
    protected $goods;

    /**
     * GoodsRepository constructor.
     * @param Goods $goods
     */
    public function __construct(Goods $goods)
    {
        $this->goods = $goods;
    }

    /**
     * 获取商品列表
     *
     * @param int $perPage
     * @param array $where
     * @return mixed
     * @author zhulinjie
     */
    public function goodsList($perPage = 10, array $where = [])
    {
        return $this->goods->where($where)->paginate($perPage);
    }

    /**
     * 添加商品操作
     *
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function addGoods($data)
    {
        return $this->goods->create($data);
    }

    /**
     * 通过ID获取一条数据
     * 
     * @param $id
     * @return mixed
     * @author zhulinjie
     */
    public function findById($id)
    {
        return $this->goods->find($id);        
    }
}