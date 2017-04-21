<?php
/**
 * Created by PhpStorm.
 * User: zhulinjie
 * Date: 2017/4/21
 * Time: 16:05
 */

namespace App\Repositories;


use App\Model\Cargo;

class CargoRepository
{
    /**
     * @var Cargo
     * @author zhulinjie
     */
    protected $cargo;

    /**
     * CargoRepository constructor.
     * @param Cargo $cargo
     */
    public function __construct(Cargo $cargo)
    {
        $this->cargo = $cargo;
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
}