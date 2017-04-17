<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\RelCategoryLabel;
use App\Repositories\CategoryLabelRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\RelCategoryLabelRepository;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * @var GoodsRepository
     * @author zhulinjie
     */
    protected $goods;

    /**
     * @var CategoryRepository
     * @author zhulinjie
     */
    protected $category;

    /**
     * @var CategoryLabelRepository
     * @author zhulinjie
     */
    protected $categoryLabel;

    /**
     * @var
     * @author zhulinjie
     */
    protected $relCL;

    /**
     * GoodsController constructor.
     * @param GoodsRepository $goods
     * @param CategoryRepository $category
     * @param CategoryLabelRepository $categoryLabel
     * @param RelCategoryLabelRepository $relCL
     */
    public function __construct
    (
        GoodsRepository $goods,
        CategoryRepository $category,
        CategoryLabelRepository $categoryLabel,
        RelCategoryLabelRepository $relCL
    )
    {
        $this->goods = $goods;
        $this->category = $category;
        $this->categoryLabel = $categoryLabel;
        $this->relCL = $relCL;

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
        $result = $this->goods->goodsList($data['perPage'], $data['where']);
        return responseMsg($result);
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
        $data['category_id'] = 21;
        $data['goods_label'] = json_encode([]);
        $data['goods_original'] = json_encode([]);
        $data['goods_thumbnail'] = json_encode([]);
        $data['goods_info'] = '商品详情';

        $res = $this->goods->addGoods($data);
        
        return responseMsg($res);
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
        $param = $request->all();
        $res = $this->category->select($param);
        return responseMsg($res);
    }

    public function getCategoryLabel(Request $request)
    {
        $param = $request->all();
        // 获取分类下的标签
        $ids = $this->relCL->fetchListsFor($param);
        foreach($ids as $id){
            $this->categoryLabel->findById($id);
        }

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
