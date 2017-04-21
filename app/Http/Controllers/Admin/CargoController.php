<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CategoryAttribute;
use App\Repositories\CategoryAttributeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsAttributeRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * 商品操作类
     *
     * @var
     * @author zhulinjie
     */
    protected $goods;

    /**
     * 分类操作类
     *
     * @var
     * @author zhulinjie
     */
    protected $category;

    /**
     * 分类标签值操作类
     *
     * @var
     * @author zhulinjie
     */
    protected $categoryAttribute;

    /**
     * 商品标签值操作类
     *
     * @var
     * @author zhulinjie
     */
    protected $goodsAttribute;

    public function __construct(
        GoodsRepository $goodsRepository,
        CategoryRepository $categoryRepository,
        CategoryAttributeRepository $categoryAttributeRepository,
        GoodsAttributeRepository $goodsAttributeRepository
    )
    {
        $this->goods = $goodsRepository;
        $this->category = $categoryRepository;
        $this->categoryAttribute = $categoryAttributeRepository;
        $this->goodsAttribute = $goodsAttributeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.cargo.show', compact('id'));
    }

    public function detail(Request $request)
    {
        $data = $request->all();

        // 获取商品信息
        $goods = $this->goods->findById($data['goods_id']);
        if (!$goods) {
            return responseMsg('该商品不存在', 404);
        }

        // 获取商品标签
        $goodsLabels = $goods->labels;

        // 获取商品标签值
        foreach($goodsLabels as $label){
            $label = $label->labels;
        }

        // 获取三级分类
        $lv3s = $this->category->findById($goods->category_id);
        if (!$lv3s) {
            return responseMsg('该分类不存在', 404);
        }

        // 获取二级分类
        $lv2s = $this->category->findById($lv3s['pid']);
        if (!$lv2s) {
            return responseMsg('该分类不存在', 404);
        }

        // 获取一级分类
        $lv1s = $this->category->findById($lv2s['pid']);
        if (!$lv1s) {
            return responseMsg('该分类不存在', 404);
        }

        // 获取分类标签
        $categoryLabels = $lv3s->labels;

        // 获取分类标签值
        foreach ($categoryLabels as $label) {
            $label = $label->labels;
        }
        
        $res['goods'] = $goods;
        $res['goodsLabels'] = $goodsLabels;
        $res['lv1s'] = $lv1s;
        $res['lv2s'] = $lv2s;
        $res['lv3s'] = $lv3s;

        return responseMsg($res);
    }

    /**
     * 添加分类标签值
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
    public function addCategoryAttr(Request $request)
    {
        $data = $request->all();
        
        // 添加操作
        $res = $this->categoryAttribute->addCategoryAttribute($data);
        
        // 判断操作是否成功
        if(!$res){
            return responseMsg('分类标签值添加失败', 400);
        }
        
        return responseMsg($res);
    }

    /**
     * 添加商品标签值
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
    public function addGoodsAttr(Request $request)
    {
        $data = $request->all();

        // 添加操作
        $res = $this->goodsAttribute->addGoodsAttribute($data);

        // 判断操作是否成功
        if(!$res){
            return responseMsg('商品标签值添加失败', 400);
        }

        return responseMsg($res);
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
}
