<?php

namespace App\Repositories;

use App\Tools\Analysis;
use App\Model\Goods;

class GoodsRepository
{
    /**
     * @var
     */
    protected $goods;

    protected $analysis;

    /**
     * GoodsRepository constructor.
     * @param Goods $goods
     */
    public function __construct(Goods $goods, Analysis $analysis)
    {
        $this->goods = $goods;
        $this->analysis = $analysis;
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

    public function addGoods($data)
    {
        $res = $this->goods::create($data);

        $tmp = $this->analysis->toUnicode('获取商品列表目止蠷暗无天日是');
        
        dd($tmp);
    }
}