<?php

namespace App\Repositories;

use App\Model\RelRecommendGood;

/**
 * Class RelReommendGood
 * @package App\Repositories
 */
class RelRecommendGoodRepository
{
    protected $relRG;

    public function __construct(RelRecommendGood $recommendGood)
    {
        $this->relRG = $recommendGood;
    }

    /**
     * 新增一条数据
     * 
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function addRelRecommendGoods($data)
    {
        return $this->relRG->create($data);
    }

    /**
     * 获取货品对应的推荐位的所有recommend_id 
     *
     * @param $cargo_id
     * @return mixed
     * @author zhulinjie
     */
    public function fetchRecommendIds($cargo_id)
    {
        return $this->relRG->where(['cargo_id' => $cargo_id])->pluck('recommend_id');
    }

    /**
     * 删除指定货品并且recommend_id不等于指定范围的数据
     * 
     * @param $cargo_id
     * @param array $data
     * @return mixed
     * @author zhulinjie
     */
    public function whereNotInRecommendIds($cargo_id, array $data)
    {
        return $this->relRG->where('cargo_id', $cargo_id)->whereNotIn('recommend_id', $data)->delete();
    }

    /**
     * 获取货品推荐位
     *
     * @param $cargo_id
     * @return mixed
     * @author zhulinjie
     */
    public function fetchRecommend($cargo_id)
    {
        return $this->relRG->where(['cargo_id' => $cargo_id])->get();
    }
}