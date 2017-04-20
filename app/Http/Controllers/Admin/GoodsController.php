<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsLabelRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\RelGoodsLabelRepository;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * 商品操作类
     *
     * @var GoodsRepository
     * @author zhulinjie
     */
    protected $goods;

    /**
     * 分类操作类
     *
     * @var CategoryRepository
     * @author zhulinjie
     */
    protected $category;

    /**
     * 商品标签操作类
     *
     * @var GoodsLabelRepository
     * @author zhulinjie
     */
    protected $goodsLabel;

    /**
     * 文件操作
     *
     * @var
     * @author zhulinjie
     */
    protected $disk;

    /**
     * 商品标签关联操作类
     *
     * @var RelGoodsLabelRepository
     * @author zhulinjie
     */
    protected $relGL;

    /**
     * GoodsController constructor.
     * @param GoodsRepository $goods
     * @param GoodsLabelRepository $goodsLabel
     * @param CategoryRepository $category
     * @author zhulinjie
     */
    public function __construct
    (
        GoodsRepository $goods,
        GoodsLabelRepository $goodsLabel,
        CategoryRepository $category,
        RelGoodsLabelRepository $relGL
    )
    {
        // 注入商品操作类
        $this->goods = $goods;
        // 注入商品标签操作类
        $this->goodsLabel = $goodsLabel;
        // 注入分类操作类
        $this->category = $category;
        // 注入七牛服务
        $this->disk = \Storage::disk('qiniu');
        // 商品标签关联操作类
        $this->relGL = $relGL;
    }

    /**
     * 商品列表界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function index()
    {
        return view('admin.goods.index');
    }

    /**
     * 获取商品列表数据
     *
     * @param Request $request
     * @return mixed
     * @author zhulinjie
     */
    public function goodsList(Request $request)
    {
        $data = $request->all();
        // 获取商品列表
        $res = $this->goods->goodsList($data['perPage'], $data['where']);
        
        return responseMsg($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // 组合商品表中需要的数据
        $param['category_id'] = $data['level3'];
        $param['goods_title'] = $data['goods_title'];
        $param['goods_original'] = json_encode($data['goods_original']);
        $param['goods_info'] = $data['goods_info'];

        try{
            \DB::beginTransaction();
            // 向商品表中新增记录
            $goods = $this->goods->addGoods($param);
            // 向商品标签关联表中新增记录
            foreach($data['goods_label'] as $val){
                $arr['goods_id'] = $goods->id;
                $arr['goods_label_id'] = $val;
                $this->relGL->add($arr);
            }
            \DB::commit();
            return responseMsg('商品添加成功');
        }catch (\Exception $e){
            \DB::rollback();
            return responseMsg('商品添加失败', 400);
        }
    }

    /**
     * 获取分类信息
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
    public function getCategory(Request $request)
    {
        $data = $request->all();
        $res = $this->category->select($data);
        return responseMsg($res);
    }

    /**
     * 获取分类下的商品标签
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
    public function getGoodsLabel(Request $request)
    {
        $data = $request->all();
        // 获取分类下的商品标签
        $goodsLabels = $this->goodsLabel->selectByCategoryId($data['category_id']);
        // 判断是否添加成功
        if($goodsLabels){
            return responseMsg($goodsLabels);
        }else{
            return responseMsg('添加商品标签失败', 400);
        }
    }

    /**
     * 添加商品标签
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhulinjie
     */
    public function addGoodsLabel(Request $request)
    {
        $data = $request->all();
        $res = $this->goodsLabel->addGoodsLable($data);
        return responseMsg($res);
    }

    /**
     * 商品图片上传
     *
     * @param Request $request
     * @return bool
     * @author zhulinjie
     */
    public function goodsImgUpload(Request $request)
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
