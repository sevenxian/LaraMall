<?php

namespace App\Repositories;

use App\Model\GoodsLabel;

/**
 * Class GoodsLabelRepository
 * @package App\Repositories
 */
class GoodsLabelRepository
{
    /**
     * @var
     * @author zhulinjie
     */
    protected $GoodsLabel;

    /**
     * GoodsLabelRepository constructor.
     * @param GoodsLabel $goodsLabel
     */
    public function __construct(GoodsLabel $goodsLabel)
    {
        $this->goodsLabel = $goodsLabel;
    }

    /**
     * 获取分类下的商品标签
     *
     * @param $id
     * @return mixed
     * @author zhulinjie
     */
    public function selectByCategoryId($id)
    {
       return $this->goodsLabel->where('category_id', $id)->get();
    }

    /**
     * 添加商品标签
     *
     * @param $data
     * @return mixed
     * @author zhulinjie
     */
    public function addGoodsLable($data)
    {
        return $this->goodsLabel->create($data);
    }
}