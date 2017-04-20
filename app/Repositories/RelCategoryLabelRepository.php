<?php

namespace App\Repositories;

use App\Model\RelCategoryLabel;

/**
 * Class CategoryLabelRepository
 * @package App\Repositories
 */
class RelCategoryLabelRepository
{
    /**
     * @var RelCategoryLabel
     * @author Luoyan
     */
    protected $relCategoryLabel;

    /**
     * 关联表模型注入
     *
     * RelCategoryLabelRepository constructor.
     * @param $relCategoryLabel
     * @author Luoyan
     */
    public function __construct(RelCategoryLabel $relCategoryLabel)
    {
        $this->relCategoryLabel = $relCategoryLabel;
    }

    /**
     * 根据传入字符串获取一列字段
     *
     * @param array $where
     * @param string $column
     * @return mixed
     * @author: Luoyan
     */
    public function fetchListsFor(array $where, $column = 'id')
    {
        return $this->relCategoryLabel->where($where)->pluck($column);
    }
}