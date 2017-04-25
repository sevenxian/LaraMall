<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\RecommendRepository;
use App\Tools\Common;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    protected $recommend;

    /**
     * IndexController constructor.
     * @param $recommend
     * @author Luoyan
     */
    public function __construct(RecommendRepository $recommend)
    {
        $this->recommend = $recommend;
    }

    /**
     * 商城首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Luoyan
     */
    public function index()
    {
        // 获取楼层和楼层下面得商品
        $recommends = $this->recommend();

        return view('home.index', compact('recommends'));
    }

    public function recommend()
    {
        return $this->recommend->recommendWithGoods();
    }
}
