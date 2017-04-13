<?php

namespace App\Repositories;

use App\Model\Goods;

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

    public function goodsList($perPage = 10){
        return $this->goods->paginate($perPage);
    }
}