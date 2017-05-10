<?php

namespace App\Repositories;

use App\Model\RelGoodsAttr;

/**
 * Class RelGoodsLabelRepository
 * @package App\Repositories
 */
class RelGoodsAttrRepository
{
    use BaseRepository;
    
    /**
     * @var RelGoodsAttr
     * @author zhulinjie
     */
    protected $model;

    /**
     * RelGoodsAttrRepository constructor.
     * @param RelGoodsAttr $relGoodsAttr
     */
    public function __construct(RelGoodsAttr $relGoodsAttr)
    {
        $this->model = $relGoodsAttr;
    }
}