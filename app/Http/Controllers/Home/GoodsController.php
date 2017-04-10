<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * 商品列表页
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function goodsList()
    {
        return view('home.goods.list');    
    }

    /**
     * 商品详情页
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function goodsDetail()
    {
        return view('home.goods.detail');
    }
}
