<?php

namespace App\Repositories;

use App\Model\IndexGoods;

class IndexGoodsRepository
{
    /**
     * @var IndexGoods
     */
    protected $indexGoods;

    /**
     * IndexGoodsRepository constructor.
     * @param IndexGoods $indexGoods
     */
    public function __construct(IndexGoods $indexGoods)
    {
        $this->indexGoods = $indexGoods;
    }

    public function add($data)
    {
        return $this->indexGoods->create($data);
    }
}