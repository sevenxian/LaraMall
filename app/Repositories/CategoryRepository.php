<?php

namespace App\Repositories;


use App\Model\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository
{

    /**
     * @var Category
     */
    protected $category;

    /**
     * 服务注入
     *
     * CategoryRepository constructor.
     * @param $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * 创建分类
     *
     * @param array $data
     * @return static
     * @author: Luoyan
     */
    public function createByCategory(array $data)
    {
        return $this->category->create($data);
    }

    /**
     * 分类搜索分页
     *
     * @param int $perPage
     * @param array $where
     * @return mixed
     * @author: Luoyan
     */
    public function categoryPaginate($perPage = 10, array $where = [])
    {
        return $this->category->with('parentCategory')->where($where)->paginate($perPage);
    }

}