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

    use BaseRepository;
    
    /**
     * @var Cargo
     * @author zhulinjie
     */
    protected $cargo;

    /**
     * CargoRepository constructor.
     * @param Cargo $cargo
     */
    public function __construct(Cargo $cargo, Analysis $analysis)
    {
        $this->model = $cargo;
    }
}