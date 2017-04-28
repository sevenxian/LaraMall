<?php

namespace App\Repositories;

use App\Model\GoodsLabel;

/**
 * Class GoodsLabelRepository
 * @package App\Repositories
 */
class GoodsLabelRepository
{
    use BaseRepository;
    
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
        $this->model = $goodsLabel;
    }

    /**
     * 根据ID查找商品 标签
     *
     * @param $where
     * @return mixed
     * @author zhangyuchao
     */
    public function getOneLabel($where)
    {
        return $this->goodsLabel->where($where)->first();
    }
}