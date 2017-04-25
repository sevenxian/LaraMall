<?php

namespace App\Repositories;

use App\Model\Recommend;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */

/**
 * Class RecommendRepository
 * @package App\Repositories
 */
class RecommendRepository
{
    /**
     * @var Recommend
     * @author Luoyan
     */
    protected $recommend;

    /**
     * 服务注入
     *
     * RecommendRepository constructor.
     * @param $recommend
     * @author Luoyan
     */
    public function __construct(Recommend $recommend)
    {
        $this->recommend = $recommend;
    }

    /**
     * 创建推荐位
     *
     * @param array $data
     * @return static
     * @author: Luoyan
     */
    public function createRecommend(array $data)
    {
        return $this->recommend->create($data);
    }

    /**
     * 分类搜索分页
     *
     * @param int $perPage
     * @param array $where
     * @return mixed
     * @author: Luoyan
     */
    public function recommendPaginate($perPage = 10, array $where = [])
    {
        return $this->recommend->withTrashed()->where($where)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * 根据 Id 修改信息
     *
     * @param $id
     * @param array $data
     * @return mixed
     * @author: Luoyan
     */
    public function updateById($id, array $data)
    {
        return $this->recommend->where('id', $id)->update($data);
    }

    /**
     * 根据 id 查找数据
     *
     * @param $id
     * @return mixed
     * @author: Luoyan
     */
    public function findById($id)
    {
        return $this->recommend->find($id);
    }

    /**
     * 获取所有的推荐位
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author zhulinjie
     */
    public function fetchAll()
    {
        return $this->recommend->all();
    }
}