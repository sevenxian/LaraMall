<?php

namespace App\Http\Controllers\Home;

use App\Repositories\AddressRepository;
use App\Repositories\CargoRepository;
use App\Repositories\GoodsAttributeRepository;
use App\Repositories\GoodsLabelRepository;
use App\Repositories\OrderDetailsRepository;
use App\Repositories\OrdersRepository;
use App\Tools\Common;
use App\Tools\LogOperation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class OrderController extends Controller
{

    /**
     * 购物车货品Hash KEY
     *
     * @var
     */
    protected $hashShoppingCart;
    /**
     *  购物车货品List KEY
     *
     * @var string
     */
    protected $listShoppingCart;
    /**
     * 货品
     *
     * @var CargoRepository
     */
    protected $cargo;
    /**
     * 商品标签
     *
     * @var GoodsLabel
     */
    protected $goodsLabel;
    /**
     * 商品标签值
     *
     * @var GoodsAttributeRepository
     */
    protected $goodsAttr;
    /**
     * 收货地址
     *
     * @var AddressRepository
     */
    protected $address;
    /**
     * 订单
     *
     * @var OrdersRepository
     */
    protected $order;
    /**
     * 日志
     *
     * @var LogOperation
     */
    protected $log;
    /**
     * 订单详情
     *
     * @var OrderDetailsRepository
     */
    protected $orderDetails;


    public function __construct
    (

        CargoRepository $cargoRepository,
        GoodsLabelRepository $goodsLabelRepository,
        GoodsAttributeRepository $goodsAttributeRepository,
        AddressRepository $addressRepository,
        OrdersRepository $ordersRepository,
        LogOperation $logOperation,
        OrderDetailsRepository $orderDetailsRepository

    )
    {
        $this->hashShoppingCart = HASH_SHOPPING_CART_INFO_;
        $this->listShoppingCart = LIST_SHOPPING_CART_INFO_;
        $this->cargo = $cargoRepository;
        $this->goodsLabel = $goodsLabelRepository;
        $this->goodsAttr = $goodsAttributeRepository;
        $this->address = $addressRepository;
        $this->order = $ordersRepository;
        $this->log = $logOperation;
        $this->orderDetails = $orderDetailsRepository;
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
     * 确认订单
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhangyuchao
     */
    public function create(Request $request)
    {
        // 获取用户ID
        $userId = \Session::get('user')->user_id;
        // 获取货品ID
        $cargoIds = explode(',', $request['cargo_id']);
        // 组装商品信息
        $data = [];
        foreach ($cargoIds as $key => $item) {
            $cargo = \Redis::hGetAll($this->hashShoppingCart . $userId . ':' . $item);
            if (empty($cargo)) {
                // 查询数据库
                $cargo = $this->cargo->find(['id' => $item]);
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
                    $label = $this->goodsLabel->find(['id' => $k]);
                    // 查询商品标签值
                    $attr = $this->goodsAttr->find(['id' => $v]);
                    // 拼装货品信息
                    if (!empty($label) && !empty($attr)) {
                        $cargo['label'][$v] = [
                            'label_name' => $label->goods_label_name,
                            'attr_name' => $attr->goods_label_name
                        ];

                    }
                }
            }
            // 填写购买数量
            $cargo['shopping_number'] = explode(',', $request['shopping_number'])[$key];
            // 组装返回数据
            $data['goods'][] = $cargo;

        }
        // 获取用户收货地址
        $address = $this->address->select(['user_id' => $userId]);
        // 判断用户是否获取成功
        if (empty($address)) {
            // 获取失败，默认为空
            $address = [];
        }
        // 继续组装返回数据
        $data['address'] = $address;
        // 返回视图
        return view('home.order.index', ['data' => $data]);

    }

    /**
     * 添加订单
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function store(Request $request)
    {
        // 获取用户ID
        $userId = \Session::get('user')->user_id;
        // 收货地址
        $address = $this->address->find(['id' => $request['address_id']]);
        if (empty($address)) {
            return responseMsg('非法操作', 400);
        }
        // 初始化总金额
        $total = 0;
        // 组装订单表数据
        $orderData = [];
        $orderData['user_id'] = $userId;
        $orderData['guid'] = Common::getUuid(); // 订单号
        $orderData['pay_type'] = $request['pay_type']; // 支付方式
        $orderData['address_message'] = json_encode($address->toArray());// 收货地址
        // 获取单个货品做准备
        $cargoes = json_decode($request['goods_message'], 1);
        foreach ($cargoes as $key => $item) {

            $cargo = \Redis::hGetAll($this->hashShoppingCart . $userId . ':' . $item['cargo_id']);
            if (empty($cargo)) {
                // 查询数据库
                $cargo = $this->cargo->find(['id' => $item['cargo_id']]);
                // 判断是否存在该商品
                if (empty($cargo)) {
                    // 记录log日志
                    // 不存在 跳出本次循环
                    continue;
                }
                $cargo = $cargo->toArray();
            }
            // 组装订单详情表数据
            $orderDetailsData[$key]['user_id'] = $userId;            // 购买用户
            $orderDetailsData[$key]['cargo_id'] = $cargo['id'];       // 货品ID
            $orderDetailsData[$key]['goods_id'] = $cargo['goods_id']; // 商品ID
            $orderDetailsData[$key]['order_guid'] = $orderData['guid'];// 订单ID
            $orderDetailsData[$key]['cargo_price'] = $cargo['cargo_discount']; // 货品价格
            $orderDetailsData[$key]['commodity_number'] = $item['shopping_number']; // 购买数量
            // 购买商品记录
            $goodsMessage[$key] = [
                'id' => $cargo['id'],
                'cargo_discount' => $cargo['cargo_discount'],
                'shopping_number' => $item['shopping_number'],
                'cargo_title' => $item['cargo_title']
            ];
            // 计算订单总金额
            $total += $cargo['cargo_discount'] * $item['shopping_number'];
        }
        // 组装订单表数据
        $orderData['goods_message'] = json_encode($goodsMessage);
        $orderData['total_amount'] = $total;

        try {
            // 开始事物
            \DB::beginTransaction();
            $orderResult = $this->order->insert($orderData);
            if (empty($orderResult)) {
                // 抛出异常
                throw new Exception(config('log.systemLog')[9]);
            }
            $orderDetailsResult = $this->orderDetails->insertManyData($orderDetailsData);
            if (empty($orderDetailsResult)) {
                // 抛出异常
                throw new Exception(config('log.systemLog')[10]);
            }
            $result = $this->payType($orderData['pay_type'], $goodsMessage, $total);
            if (empty($result)) {
                throw new Exception(config('log.systemLog')[12]);
            }
            \DB::commit();
            // 下单成功从购物车里删除该货品
//            foreach ($data as $item) {
//                $delResult = \Redis::del($this->hashShoppingCart.$userId.$item['cargo_id']);
//                if(empty($delResult)) {
//                    $logMessage = Common::logMessageForInside($userId,config('log.systemLog')[11],$item);
//                    $this->log->writeSystemLog($logMessage);
//                }
//            }


            return responseMsg($result, 200);
        } catch (Exception $e) {
            // 事物回滚
            \DB::rollBack();
            // 组装填写log日志
            $logMessage = Common::logMessageForInside($userId, $e->getMessage());
            // 写入log日志
            $this->log->writeSystemLog($logMessage);
            // 返回失败信息
            return responseMsg('下单失败', 400);
        }


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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * 支付类型
     *
     * @param $type  支付类型
     * @param $data 商品信息
     * @param $total 总金额
     * @return mixed
     * @author zhangyuchao
     */
    private function payType($type, $data, $total)
    {

        switch ($type) {
            case 1:
                //$this->
                break;
            case 2:
                $tmp = $this->aliPay($data, $total);
                break;
        }

        return $tmp;
    }

    /**
     * 支付宝支付
     *
     * @param $data
     * @param $total
     * @return mixed
     * @author zhangyuchao
     */
    private function aliPay($data, $total)
    {
        // 创建支付单。
        $aliPay = app('alipay.web');
        $orderId = time();
        // $orderPrice = $total;
        $orderPrice = 0.01;
        if (count($data) > 1) {
            $goodsName = "合并" . count($data) . '笔订单,共' . array_sum(array_map(function ($item) {
                    return $item['shopping_number'];
                }, $data)) . '件商品';
            $goodsDescription = '';
        } else {
            $goodsName = $data[0]['cargo_title'];
            $goodsDescription = '';
        }


        $aliPay->setOutTradeNo($orderId);
        $aliPay->setTotalFee($orderPrice);
        $aliPay->setSubject($goodsName);
        $aliPay->setBody($goodsDescription);
        return $aliPay->getPayLink();
    }

    public function aliPayCogradient(Request $request)
    {
        if($request['trade_status'] == 'TRADE_SUCCESS' || $request['trade_status'] == 'TRADE_FINISHED') {

        }
        return view('');
    }
}
