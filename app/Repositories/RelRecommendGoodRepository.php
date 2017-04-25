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
    public function addRelRecommendGood($data)
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

    public function whereNotInDelete($where, $data)
    {
        return $this->relRG->where($where)->whereNotIn('recommend_id', $data)->delete();
    }
}