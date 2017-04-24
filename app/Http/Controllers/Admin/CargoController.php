<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CargoRepository;
use App\Repositories\CategoryAttributeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsAttributeRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\IndexGoodsRepository;
use App\Repositories\RelLabelCargoRepository;
use App\Tools\Analysis;
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

    /**
     * 文件操作
     *
     * @var
     * @author zhulinjie
     */
    protected $disk;

    /**
     * 货品操作类
     *
     * @var
     * @author zhulinjie
     */
    protected $cargo;

    /**
     * 标签值货品关联操作类
     * 
     * @var
     * @author zhulinjie
     */
    protected $relLabelCargo;

    /**
     * 分词类
     *
     * @var
     * @author zhulinjie
     */
    protected $analysis;

    /**
     * 商品索引操作类
     *
     * @var
     * @author zhulinjie
     */
    protected $indexGoods;

    /**
     * CargoController constructor.
     * @param GoodsRepository $goodsRepository
     * @param CategoryRepository $categoryRepository
     * @param CategoryAttributeRepository $categoryAttributeRepository
     * @param GoodsAttributeRepository $goodsAttributeRepository
     */
    public function __construct(
        GoodsRepository $goodsRepository,
        CategoryRepository $categoryRepository,
        CategoryAttributeRepository $categoryAttributeRepository,
        GoodsAttributeRepository $goodsAttributeRepository,
        CargoRepository $cargoRepository,
        RelLabelCargoRepository $relLabelCargoRepository,
        Analysis $analysis,
        IndexGoodsRepository $indexGoodsRepository
    )
    {
        // 注入商品操作类
        $this->goods = $goodsRepository;
        // 注入分类操作类
        $this->category = $categoryRepository;
        // 注入分类标签值操作类
        $this->categoryAttribute = $categoryAttributeRepository;
        // 注入商品标签值操作类
        $this->goodsAttribute = $goodsAttributeRepository;
        // 注入货品操作类
        $this->cargo = $cargoRepository;
        // 注入七牛服务
        $this->disk = \Storage::disk('qiniu');
        // 注入标签值货品关联操作类
        $this->relLabelCargo = $relLabelCargoRepository;
        // 注入分词类
        $this->analysis = $analysis;
        // 注入商品索引操作类
        $this->indexGoods = $indexGoodsRepository;
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
     * 货品添加
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addCargo($id)
    {
        return view('admin.cargo.addCargo', compact('id'));
    }

    /**
     * 获取货品相关信息
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
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
     * 货品图片上传
     *
     * @param Request $request
     * @return bool
     * @author zhulinjie
     */
    public function cargoImgUpload(Request $request)
    {
        // 判断是否有图片上传
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // 检测图片是否合法
            if(checkImage($file)){
                // 上传图片到七牛云 返回图片路径名
                $filename = $this->disk->put(IMAGE_PATH, $file);
                return responseMsg($filename);
            }else{
                return responseMsg('图片格式不合法', 400);
            }
        }
        return responseMsg('暂无图片上传', 404);
    }

    /**
     * 新增货品操作
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $list = [];
        $categoryAttrIds = [];
        foreach($data as $key => $val){
            // 获取货品标签
            if(strpos($key, 'goodsLabel') !== false){
                $list[str_replace('goodsLabel', '', $key)] = $val;
            }
            // 获取分类标签值
            if(strpos($key, 'categoryLabel') !== false){
                $categoryAttrIds[] = $val;
            }
        }

        // 组合货品表中需要的数据
        $param['category_id'] = $data['category_id'];
        $param['goods_id'] = $data['goods_id'];
        $param['cargo_ids'] = json_encode($list);
        $param['cargo_cover'] = $data['cargo_original'][0];
        $param['inventory'] = $data['inventory'];
        $param['cargo_price'] = $data['cargo_price'];
        $param['cargo_discount'] = $data['cargo_discount'];
        $param['cargo_original'] = json_encode($data['cargo_original']);
        $param['cargo_info'] = $data['cargo_info'];

        // 获取三级分类
        $lv3s = $this->category->findById($data['category_id']);
        if (!$lv3s) {
            return responseMsg('该分类不存在', 404);
        }
        // 分词处理 三级分类名称
        $body[] = $this->analysis->toUnicode($lv3s->name);
        $body = array_merge($body, $this->analysis->QuickCut($lv3s->name));

        // 获取二级分类
        $lv2s = $this->category->findById($lv3s['pid']);
        if (!$lv2s) {
            return responseMsg('该分类不存在', 404);
        }
        // 分词处理 二级分类名称
        array_push($body, $this->analysis->toUnicode($lv2s->name));
        $body = array_merge($body, $this->analysis->QuickCut($lv2s->name));

        // 获取一级分类
        $lv1s = $this->category->findById($lv2s['pid']);
        if (!$lv1s) {
            return responseMsg('该分类不存在', 404);
        }
        // 分词处理 一级分类名称
        array_push($body, $this->analysis->toUnicode($lv1s->name));
        $body = array_merge($body, $this->analysis->QuickCut($lv1s->name));

        // 获取商品信息
        $goods = $this->goods->findById($data['goods_id']);
        if (!$goods) {
            return responseMsg('该商品不存在', 404);
        }
        // 分词处理 商品标题
        array_push($body, $this->analysis->toUnicode($goods->goods_title));
        $body = array_merge($body, $this->analysis->QuickCut($goods->goods_title));

        // 获取分类标签值
        if($categoryAttrIds){
            $categoryAttrs = $this->categoryAttribute->selectByWhereIn($categoryAttrIds);
            foreach($categoryAttrs as $categoryAttr){
                // 分词处理 分类标签值
                array_push($body, $this->analysis->toUnicode($categoryAttr->attribute_name));
                $body = array_merge($body, $this->analysis->QuickCut($categoryAttr->attribute_name));
            }
        }

        try{
            \DB::beginTransaction();
            // 向货品表中新增记录
            $cargo = $this->cargo->addCargo($param);

            // 分类标签值与货品关联表中新增记录
            if($categoryAttrIds){
                foreach($categoryAttrIds as $id){
                    $arr['category_attr_id'] = $id;
                    $arr['goods_id'] = $data['goods_id'];
                    $arr['cargo_id'] = $cargo->id;
                    $this->relLabelCargo->add($arr);
                }
            }

            // 向商品索引表中新增记录
            $indexs['goods_id'] = $data['goods_id'];
            $indexs['cargo_id'] = $cargo->id;
            $indexs['body'] = implode(' ', $body);
            $this->indexGoods->add($indexs);
            
            // 将货品信息存储到redis
            \Redis::hmset(HASH_CARGO_INFO_ . $cargo->id, $cargo->toArray());
            
            \DB::commit();
            return responseMsg('货品添加成功');
        }catch (\Exception $e){
            \DB::rollback();
            dd($e->getMessage());
            return responseMsg('货品添加失败', 400);
        }
    }

    /**
     * 货品列表界面
     * 
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function cargoList($id)
    {
        return view('admin.cargo.list', compact('id'));
    }

    /**
     * 获取货品列表数据
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
    public function getCargoList(Request $request)
    {
        $data = $request->all();
        // 获取货品列表数据
        $res = $this->cargo->cargoList($data['perPage'], ['goods_id'=>$data['goods_id']]);

        return responseMsg($res);
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
}
