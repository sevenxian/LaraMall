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

    /**
     * @var Analysis
     */
    protected $analysis;

    /**
     * @var
     */
    protected $indexGoods;

    /**
     * GoodsRepository constructor.
     * @param Goods $goods
     * @param Analysis $analysis
     * @param IndexGoodsRepository $indexGoods
     */
    public function __construct(Goods $goods, Analysis $analysis, IndexGoodsRepository $indexGoods)
    {
        $this->goods = $goods;
        $this->analysis = $analysis;
        $this->indexGoods = $indexGoods;
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
        return $this->goods::create($data);
        
//        $body = $this->analysis->QuickCut($data['goods_title']);
//
//        $arr['goods_id'] = $res->id;
//        $arr['cargo_id'] = 1;
//        $arr['body'] = implode(' ', $body);

//        return $this->indexGoods->add($arr);
    }

    public function findById($id)
    {
        return $this->goods->find($id);        
    }
}