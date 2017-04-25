<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\CargoRepository;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * 货品操作类
     *
     * @var CargoRepository
     * @author zhulinjie
     */
    protected $cargo;

    public function __construct(CargoRepository $cargoRepository)
    {
        // 注入货品操作类
        $this->cargo = $cargoRepository;
    }

    /**
     * 商品列表页
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function goodsList()
    {
        $cargos = $this->cargo->cargoList(2, ['category_id' => 9]);
        return view('home.goods.list', compact('cargos'));
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

    /**
     * 购物车
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function shopCart()
    {
        return view('home.goods.shopCart');
    }

    /**
     * 分类
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function sort(){
        return view('home.goods.sort');
    }
}
