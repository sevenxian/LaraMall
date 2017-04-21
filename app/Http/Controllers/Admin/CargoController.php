<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CargoRepository;
use App\Repositories\CategoryAttributeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsAttributeRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\RelLabelCargoRepository;
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
     * @var
     * @author zhulinjie
     */
    protected $relLabelCargo;

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
        RelLabelCargoRepository $relLabelCargoRepository
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
        $this->relLabelCargo = $relLabelCargoRepository;
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

        try{
            \DB::beginTransaction();
            // 向货品表中新增记录
            $cargo = $this->cargo->addCargo($param);

            // 分类标签值与货品关联表中新增记录
            foreach($categoryAttrIds as $id){
                $arr['category_attr_id'] = $id;
                $arr['goods_id'] = $data['goods_id'];
                $arr['cargo_id'] = $cargo->id;
                $this->relLabelCargo->add($arr);
            }
            \DB::commit();
            return responseMsg('货品添加成功');
        }catch (\Exception $e){
            \DB::rollback();
            return responseMsg('货品添加失败', 400);
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
        return view('admin.cargo.show', compact('id'));
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
