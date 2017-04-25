<?php

namespace App\Repositories;

use App\Model\RelGoodsLabel;

/**
 * Class RelGoodsLabelRepository
 * @package App\Repositories
 */
class RelGoodsLabelRepository
{
    /**
     * @var RelGoodsLabel
     * @author zhulinjie
     */
    protected $relGL;

    /**
     * RelGoodsLabelRepository constructor.
     * @param RelGoodsLabel $relGL
     */
    public function __construct(RelGoodsLabel $relGL)
    {
        $this->relGL = $relGL;
    }

    /**
     * 向商品标签关联表中新增一条记录
     *
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function add($data)
    {
        return $this->relGL->create($data);
    }
}