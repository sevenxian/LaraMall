<?php

namespace App\Http\Controllers\Home;

use App\Repositories\CargoRepository;
use App\Repositories\GoodsCollectionRepository;
use App\Repositories\RelLabelCargoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalController extends Controller
{
    /**
     * @var GoodsCollectionRepository
     */
    protected $goodsCollection;

    protected $cargo;

    protected $relLabelCargo;


    public function __construct
    (
        GoodsCollectionRepository $collectionRepository,
        CargoRepository $cargoRepository,
        RelLabelCargoRepository $relLabelCargoRepository

    )
    {
        $this->goodsCollection = $collectionRepository;
        $this->cargo = $cargoRepository;
        $this->relLabelCargo = $relLabelCargoRepository;
    }

    /**
     * 个人中心首页
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function index()
    {
        // 拼装收藏列表条件
        $where['user_id'] = \Session::get('user')->user_id;
        // 查询收藏列表
        $result = $this->goodsCollection->paging($where);
        // 初始化返回数组
        $data = [];
        // 判断是否查询成功
        if(!empty($result)) {
            // 便利收藏列表
            foreach ($result as $key => $value) {
                // 根据货品ID查询货品
                $cargo = $this->cargo->find(['id' => $value->cargo_id]);

                if(!empty($cargo)) {
                    $data[$key]['cargo_id'] = $cargo->id;
                    $data[$key]['category_id'] = $cargo->category_id;   // 分类ID
                    $data[$key]['goods_id']    = $cargo->goods_id;      // 商品ID
                    $data[$key]['cargo_name']  = $cargo->cargo_name;    // 货品名称
                    $data[$key]['cargo_cover'] = $cargo->cargo_cover;   // 货品封面
                    $data[$key]['cargo_price'] = $cargo->cargo_price;   // 货品原价
                    $data[$key]['cargo_discount'] = $cargo->cargo_discount; //商品现价
                    $data[$key]['cargo_status'] = $cargo->cargo_status; // 商品上下架
                    // 收藏数
                    $data[$key]['cargo_collection'] = $this->goodsCollection->count(['cargo_id' =>$value->cargo_id ]);
                    // 相似
                    $data[$key]['category_attr_id'] = $this->relLabelCargo->find(['cargo_id' => $value->cargo_id]);
                }
            }

        }
        return view('home.personal.index',['data' => $data,'page' => $result]);

    }
    
    public function information(){
        return view('home.personal.information');
    }
}
