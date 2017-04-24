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

    /**
     * 新增一条记录
     * 
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function add($data)
    {
        return $this->indexGoods->create($data);
    }
}