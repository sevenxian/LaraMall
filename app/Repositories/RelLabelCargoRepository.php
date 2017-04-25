<?php
/**
 * Created by PhpStorm.
 * User: zhulinjie
 * Date: 2017/4/21
 * Time: 16:05
 */

namespace App\Repositories;

use App\Model\RelLabelCargo;

/**
 * Class RelLabelCargoRepository
 * @package App\Repositories
 */
class RelLabelCargoRepository
{
    /**
     * @var RelLabelCargo
     * @author zhulinjie
     */
    protected $relLabelCargo;

    /**
     * RelLabelCargoRepository constructor.
     * @param RelLabelCargo $relLabelCargo
     */
    public function __construct(RelLabelCargo $relLabelCargo)
    {
        $this->relLabelCargo = $relLabelCargo;
    }

    /**
     * 新增一条数据
     *
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function add($data)
    {
        return $this->relLabelCargo->create($data);
    }
}