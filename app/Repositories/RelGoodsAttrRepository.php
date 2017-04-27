<?php

namespace App\Repositories;

use App\Model\RelGoodsAttr;

/**
 * Class RelGoodsLabelRepository
 * @package App\Repositories
 */
class RelGoodsAttrRepository
{
    /**
     * @var RelGoodsAttr
     * @author zhulinjie
     */
    protected $relGoodsAttr;

    public function __construct(RelGoodsAttr $relGoodsAttr)
    {
        $this->relGoodsAttr = $relGoodsAttr;
    }

    /**
     * 向商品标签值关联表中新增记录
     *
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function add($data)
    {
        return $this->relGoodsAttr->create($data);
    }

    /**
     * 获取一条记录
     * 
     * @param array $where
     * @return mixed
     * @author zhulinjie
     */
    public function find(array $where)
    {   
        return $this->relGoodsAttr->where($where)->first();
    }
}