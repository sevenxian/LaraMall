<?php
/**
 * Created by PhpStorm.
 * User: zhulinjie
 * Date: 2017/4/21
 * Time: 16:05
 */

namespace App\Repositories;


use App\Model\Cargo;
use App\Model\IndexGoods;
use App\Tools\Analysis;

class CargoRepository
{
    /**
     * @var Cargo
     * @author zhulinjie
     */
    protected $cargo;

    /**
     * @var
     * @author zhulinjie
     */
    protected $analysis;

    /**
     * @var
     * @author zhulinjie
     */
    protected $indexGoods;

    /**
     * CargoRepository constructor.
     * @param Cargo $cargo
     */
    public function __construct(Cargo $cargo, Analysis $analysis, IndexGoods $indexGoods)
    {
        $this->cargo = $cargo;
        $this->analysis = $analysis;
        $this->indexGoods = $indexGoods;
    }

    /**
     * 添加货品
     * 
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function addCargo($data)
    {
        return $this->cargo->create($data);
    }

    /**
     * 获取货品列表
     * 
     * @param int $perPage
     * @param array $where
     * @return mixed
     * @author zhulinjie
     */
    public function cargoList($perPage = 10, array $where = [])
    {
        return $this->cargo->where($where)->paginate($perPage);
    }
}