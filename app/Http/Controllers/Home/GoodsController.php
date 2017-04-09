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
    public function list()
    {
        return view('home.goods.list');    
    }
    
    public function detail()
    {
        return view('home.goods.detail');
    }
}
