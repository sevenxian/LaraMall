<?php
/**
 * Created by PhpStorm.
 * User: zhulinjie
 * Date: 2017/4/21
 * Time: 9:46
 */

namespace App\Repositories;


use App\Model\CategoryAttribute;

class CategoryAttributeRepository
{
    /**
     * 分类标签值操作类
     *
     * @var CategoryAttribute
     * @author zhulinjie
     */
    protected $categoryAttrbute;

    public function __construct(CategoryAttribute $categoryAttribute)
    {
        // 注入分类标签值操作类
        $this->categoryAttrbute = $categoryAttribute;
    }

    /**
     * 添加分类标签值
     * 
     * @param $data
     * @return static
     * @author zhulinjie
     */
    public function addCategoryAttribute($data)
    {
        return $this->categoryAttrbute->create($data);
    }

    /**
     * 通过一组ID获取多条记录
     *
     * @param $id
     * @author zhulinjie
     */
    public function selectByWhereIn($ids)
    {
        return $this->categoryAttrbute->whereIn('id', $ids)->get();
    }
}