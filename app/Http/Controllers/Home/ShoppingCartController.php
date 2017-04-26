<?php

namespace App\Http\Controllers\Home;

use App\Repositories\CargoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingCartController extends Controller
{
    protected $cargo;

    public function __construct(CargoRepository $cargoRepository)
    {
        $this->cargo = $cargoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取货品ID
        $cargoId = $request['cargo_id'];
        // 加入购物车的数量
        $number = empty($request['number'])?1:$request['number'];
        // 获取用户ID
        $userId = \Session::get('user')->user_id;
        // 判断该条货品的key是否存在
        if(\Redis::exists(HASH_SHOPPING_CART_INFO_.$userId.':'.$cargoId)) {
            //
            $increaseResult = \Redis::hincrBy(HASH_SHOPPING_CART_INFO_.$userId.':'.$cargoId,'shopping_number',$number);
            if(empty($increaseResult)) {
               // 记录log日志
               return responseMsg('添加购物车失败!',400);
            }
        } else {
            // 第一次加入购物车 获取货品信息
            $cargo = $this->cargo->findOneCargo(['id'=>$request['cargo_id']]);
            // 判断货品信息获取是否成功
            if(empty($cargo)) {
                return responseMsg('获取商品信息失败!',400);
            }
            // 转为数组，以便存入redis
            $cargo = $cargo->toArray();
            // 获取添加数量
            $cargo['shopping_number'] = $number;
            // 存入缓存
            $hashResult = \Redis::hMset(HASH_SHOPPING_CART_INFO_.$userId.':'.$cargoId,$cargo);
            if(empty($hashResult)) {
                // 记录log日志
                return responseMsg('加入购物车失败!',400);
            }
            // 存入列表
            $listResult = \Redis::rPush(LIST_SHOPPING_CART_INFO_.$userId,HASH_SHOPPING_CART_INFO_.$userId.':'.$cargoId);
            // 列表数据存入是否成功
            if(empty($listResult)) {
                // 不成功 删除hash记录
                $hDelResult = \Redis::hDel(HASH_SHOPPING_CART_INFO_.$userId.':'.$cargoId,$cargo);
                if(empty($hDelResult)) {
                    // 记录失败数据
                }
                // 记录log日志
                return responseMsg('加入购物车失败!',400);
            }
        }
        // 返回数量,以便修改页面购物车数量
        return responseMsg($number,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
