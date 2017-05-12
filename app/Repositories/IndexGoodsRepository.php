<?php

namespace App\Repositories;

use App\Model\IndexGoods;

/**
 * Class IndexGoodsRepository
 * @package App\Repositories
 */
class IndexGoodsRepository
{
    use BaseRepository;
    
    /**
     * @var IndexGoods
     */
    protected $model;

    /**
     * IndexGoodsRepository constructor.
     * @param IndexGoods $indexGoods
     */
    public function __construct(IndexGoods $indexGoods)
    {
        $this->model = $indexGoods;
    }
}