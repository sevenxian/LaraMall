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

/**
 * Class CargoRepository
 * @package App\Repositories
 */
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
    protected $indexGoods;

    /**
     * CargoRepository constructor.
     * @param Cargo $cargo
     */
    public function __construct(Cargo $cargo, Analysis $analysis, IndexGoods $indexGoods)
    {
        $this->cargo = $cargo;
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

    /**
     * 通过ID获取一条记录
     * 
     * @param $id
     * @return mixed
     * @author zhulinjie
     */
    public function findById($id)
    {
        return $this->cargo->find($id);   
    }

    /**
     * 获取一条数据
     *
     * @param array $where
     * @return mixed
     * @author zhulinjie
     */
    public function find(array $where)
    {
        return $this->cargo->where($where)->first();
    }

    /**
     * 获取货品规格
     *
     * @param array $where
     * @return mixed
     * @author zhulinjie
     */
    public function getCargoIds(array $where)
    {
        return $this->cargo->where($where)->pluck('cargo_ids');
    }
}