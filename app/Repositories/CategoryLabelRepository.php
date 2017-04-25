<?php

namespace App\Repositories;

use App\Model\CategoryLabel;

/**
 * Class CategoryLabelRepository
 * @package App\Repositories
 */
class CategoryLabelRepository
{

    /**
     * 分类标签模型
     *
     * @var CategoryLabel
     * @author Luoyan
     */
    protected $categoryLabel;

    /**
     * 模型注入
     *
     * CategoryLabelRepository constructor.
     * @param $categoryLabel
     * @author Luoyan
     */
    public function __construct(CategoryLabel $categoryLabel)
    {
        $this->categoryLabel = $categoryLabel;
    }

    /**
     * 创建分类标签
     *
     * @param array $data
     * @return static
     * @author: Luoyan
     */
    public function createCategoryLabel(array $data)
    {
        return $this->categoryLabel->create($data);
    }

    /**
     * 获取所有分类下的标签
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author: Luoyan
     */
    public function fetchLabels()
    {
        return $this->categoryLabel->all();
    }

    /**
     * 根据ID查找数据
     *
     * @param $id
     * @return mixed
     * @author zhulinjie
     */
    public function findById($id)
    {
        return $this->categoryLabel->find($id);
    }
}