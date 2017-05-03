<?php

namespace App\Http\Controllers\Home;


use App\Repositories\CargoRepository;
use App\Repositories\GoodsAttributeRepository;
use App\Repositories\GoodsLabelRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingCartController extends Controller
{
    /**
     * @var CargoRepository
     */
    protected $cargo;
    /**
     * @var string
     */
    protected $hashShoppingCart;
    /**
     * @var string
     */
    protected $listShoppingCart;
    /**
     * @var GoodsLabel
     */
    protected $goodsLabel;
    /**
     * @var GoodsAttributeRepository
     */
    protected $goodsAttr;

    public function __construct
    (
        CargoRepository $cargoRepository,
        GoodsLabelRepository $goodsLabelRepository,
        GoodsAttributeRepository $goodsAttributeRepository
    )
    {
        $this->cargo = $cargoRepository;
        $this->hashShoppingCart = HASH_SHOPPING_CART_INFO_;
        $this->listShoppingCart = LIST_SHOPPING_CART_INFO_;
        $this->goodsLabel = $goodsLabelRepository;
        $this->goodsAttr = $goodsAttributeRepository;


    }

    /**
     * 购物车列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhangyuchao
     */
    public function index()
    {
        // 初始化返回数组
        $data = [];
        // 获取用户ID
        $userId = \Session::get('user')->user_id;
        // 查看用户购物车是否存在商品
        $listLength = \Redis::lLen($this->listShoppingCart . $userId);
        // 读取购物车商品
        if (!empty($listLength)) {
            // 获取hash的KEY便于取出所有商品
            $keys = \Redis::lRange($this->listShoppingCart . $userId, 0, $listLength);
            // 获取长度判断
            if (!empty($keys)) {
                // 循环便利购物车hash的key
                foreach ($keys as $key => $item) {
                    // 从缓存中获取货品信息
                    $cargo = \Redis::hGetAll($item);
                    // 判断货品信息是否获取成功
                    if (empty($cargo)) {
                        // 查分查询数据库需要信息
                        $cargoId = explode(':', $item)[5];
                        // 查询数据库
                        $cargo = $this->cargo->findOneCargo(['id' => $cargoId]);
                        // 判断是否存在该商品
                        if (empty($cargo)) {
                            // 记录log日志
                            // 不存在 跳出本次循环
                            continue;
                        }
                        $cargo = $cargo->toArray();
                    }
                    // 获取商品标签
                    if (!empty($cargo['cargo_ids'])) {
                        // 商品标签转为数组
                        $labels = json_decode($cargo['cargo_ids'], 1);
                        // 便利标签
                        foreach ($labels as $k => $v) {
                            // 查询商品标签
                            $label = $this->goodsLabel->getOneLabel(['id' => $k]);
                            // 查询商品标签值
                            $attr = $this->goodsAttr->getOneGoodsAttr(['id' => $v]);
                            // 拼装货品信息
                            if (!empty($label) && !empty($attr)) {
                                $cargo['label'][$v] = [
                                    'label_name' => $label->goods_label_name,
                                    'attr_name' => $attr->goods_label_name
                                ];

                            }
                        }
                    }
                    // 组装数据
                    $data[$key] = $cargo;
                }
            }
        }
        // 返回视图
        return view('home.shoppingCart.index', ['data' => $data]);
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
     * 添加购物车
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function store(Request $request)
    {
        // 获取货品ID
        $cargoId = $request['cargo_id'];
        // 加入购物车的数量
        $number = empty($request['number']) ? 1 : $request['number'];
        // 获取用户ID
        $userId = \Session::get('user')->user_id;
        // 判断该条货品的key是否存在
        if (\Redis::exists($this->hashShoppingCart . $userId . ':' . $cargoId)) {
            //
            $increaseResult = \Redis::hincrBy($this->hashShoppingCart . $userId . ':' . $cargoId, 'shopping_number', $number);
            if (empty($increaseResult)) {
                // 记录log日志
                return responseMsg('添加购物车失败!', 400);
            }
        } else {
            // 第一次加入购物车 获取货品信息
            $cargo = $this->cargo->findOneCargo(['id' => $request['cargo_id']]);
            // 判断货品信息获取是否成功
            if (empty($cargo)) {
                return responseMsg('获取商品信息失败!', 400);
            }
            // 转为数组，以便存入redis
            $cargo = $cargo->toArray();
            // 获取添加数量
            $cargo['shopping_number'] = $number;
            // 存入缓存
            $hashResult = \Redis::hMset($this->hashShoppingCart . $userId . ':' . $cargoId, $cargo);
            if (empty($hashResult)) {
                // 记录log日志
                return responseMsg('加入购物车失败!', 400);
            }
            // 存入列表
            $listResult = \Redis::rPush($this->listShoppingCart . $userId, $this->hashShoppingCart . $userId . ':' . $cargoId);
            // 列表数据存入是否成功
            if (empty($listResult)) {
                // 不成功 删除hash记录
                $hDelResult = \Redis::hDel($this->hashShoppingCart . $userId . ':' . $cargoId, $cargo);
                if (empty($hDelResult)) {
                    // 记录失败数据
                }
                // 记录log日志
                return responseMsg('加入购物车失败!', 400);
            }
        }
        // 返回数量,以便修改页面购物车数量
        return responseMsg($number, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除购物车记录
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function destroy(Request $request)
    {
        // 获取用户ID
        $userId = \Session::get('user')->user_id;
        // 获取货品ID
        foreach ($request['cargoId'] as $value){
            // 判断货品是否存在缓存中
            if(\Redis::exists($this->hashShoppingCart . $userId . ':' . $value)) {
                // 从缓存中删除货品
                $result = \Redis::del($this->hashShoppingCart . $userId . ':' . $value);
                if(!$result) {
                    // 记录log日志
                }
            }
            // 删除缓存中list记录
            \Redis::lRem($this->listShoppingCart.$userId,0,$this->hashShoppingCart . $userId . ':' . $value);
        }

        // 返回信息
        return responseMsg('删除成功',200);
    }
}
