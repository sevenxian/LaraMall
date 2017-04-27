<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\RecommendRepository;
use App\Tools\Common;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @var RecommendRepository
     * @author zhulinjie
     */
    protected $recommend;

    /**
     * @var CategoryRepository
     * @author zhulinjie
     */
    protected $category;

    /**
     * IndexController constructor.
     * @param RecommendRepository $recommend
     * @param CategoryRepository $categoryRepository
     */
    public function __construct
    (
        RecommendRepository $recommend,
        CategoryRepository $categoryRepository
    )
    {
        $this->recommend = $recommend;
        $this->category = $categoryRepository;
    }

    /**
     * 商城首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Luoyan
     */
    public function index()
    {
        // 获取分类信息
        $categorys = $this->category->select(['level'=>1]);
        foreach ($categorys as $category){
            $category->children = $this->category->select(['pid'=>$category->id]);
            foreach ($category->children as $children){
                $children->grandchild = $this->category->select(['pid'=>$children->id]);
            }
        }

        // 获取楼层和楼层下面得商品
        $recommends = $this->recommend->recommendWithGoods();

//        return $categorys;

//        dd($recommends->toArray());

        return view('home.index', compact('recommends'), compact('categorys'));
    }
}
