<?php

namespace App\Repositories;

use App\Model\RelGoodsLabel;

/**
 * Class RelGoodsLabelRepository
 * @package App\Repositories
 */
class RelGoodsLabelRepository
{
    use BaseRepository;
    
    /**
     * @var RelGoodsLabel
     * @author zhulinjie
     */
    protected $model;

    /**
     * RelGoodsLabelRepository constructor.
     * @param RelGoodsLabel $relGL
     */
    public function __construct(RelGoodsLabel $relGL)
    {
        $this->model = $relGL;
    }
}