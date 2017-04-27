<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\CargoRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * 货品
     *
     * @var CargoRepository
     * @author zhulinjie
     */
    protected $cargo;

    /**
     * 商品
     *
     * @var
     * @author zhulinjie
     */
    protected $goods;

    /**
     * 分类
     *
     * @var
     * @author zhulinjie
     */
    protected $category;

    /**
     * GoodsController constructor.
     * @param CargoRepository $cargoRepository
     * @param CategoryRepository $categoryRepository
     * @param GoodsRepository $goodsRepository
     */
    public function __construct
    (
        CargoRepository $cargoRepository,
        CategoryRepository $categoryRepository,
        GoodsRepository $goodsRepository
    )
    {
        // 注入货品操作类
        $this->cargo = $cargoRepository;
        // 注入分类操作类
        $this->category = $categoryRepository;
        // 注入商品操作类
        $this->goods = $goodsRepository;
    }

    /**
     * 商品列表页
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function goodsList($category_id)
    {
        $cargos = $this->cargo->cargoList(PAGENUM, ['category_id' => $category_id]);
        return view('home.goods.list', compact('cargos'));
    }

    /**
     * 商品详情页
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function goodsDetail($cargo_id)
    {
        // 获取分类信息
        $category = $this->category->select();

        // 获取货品信息
        $cargo = $this->cargo->findById($cargo_id);

        // 获取当前货品拥有的商品规格组合
        $cargo_ids = json_decode($cargo->cargo_ids, 1);

        $cids = [];
        foreach($cargo_ids as $k => $v){
            $cids = array_unique(array_merge($cids, $this->cargo->select(['cargo_ids->'.$k => $v])->toArray()));
        }

        /**
         * array:3 [▼
         * 0 => "{"1": "2", "2": "3"}"
         * 1 => "{"1": "2", "2": "4"}"
         * 2 => "{"1": "1", "2": "3"}"
         * ]
         */
        $cids = collect($cids)->toArray();

        // 转换格式
        foreach ($cids as $val){
            foreach(json_decode($val, 1) as $k => $v){
                $tmp[] = $k.':'.$v;
            }
        }
        
        /**
         * array:4 [▼
         * 0 => "1:2"
         * 1 => "2:3"
         * 3 => "2:4"
         * 4 => "1:1"
         * ]
         */
        $cids = array_unique($tmp);

        // 查找家谱树
        $tree = array_reverse($this->tree($category->toArray(), $cargo->category_id));

        // 获取商品标签
        $goods = $this->goods->findById($cargo->goods_id);

        $data['category'] = $category;
        $data['cargo'] = $cargo;
        $data['tree'] = $tree;
        $data['goods'] = $goods;
        $data['cids'] = $cids;

        return view('home.goods.detail', compact('data'));
    }

    // 获取货品ID
    public function getCargoId(Request $request)
    {
        $data = $request->all();

        // 判断货品ID在redis中是否存在
        $cargo_ids = md5(json_encode($data));
        if(\Redis::get(STRING_CARGO_STANDARD_ . $cargo_ids)){
            return responseMsg(\Redis::get(STRING_CARGO_STANDARD_ . $cargo_ids));
        }

        // 组合查询条件
        $where = [];
        foreach ($data as $k => $v){
            $where['cargo_ids->'.$k] = $v;
        }
        
        // 获取货品信息
        $cargo = $this->cargo->find($where);

        // 存入redis
        \Redis::set(STRING_CARGO_STANDARD_ . $cargo_ids, $cargo->id);

        if(!$cargo){
            return responseMsg('该货品不存在', 404);
        }
        
        return responseMsg($cargo->id);
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

    /**
     * 查找家谱树
     *
     * @param $arr
     * @param $id
     * @return array
     * @author zhulinjie
     */
    public function tree($arr,$id){
        $tree = array();
        while($id != 0){
            foreach($arr as $v){
                if($v['id'] == $id){
                    $tree[] = $v;

                    $id = $v['pid'];
                    break;
                }
            }
        }
        return $tree;
    }
}
