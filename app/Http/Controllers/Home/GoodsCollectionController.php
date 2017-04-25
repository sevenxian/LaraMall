<?php

namespace App\Http\Controllers\Home;

use App\Repositories\GoodsCollectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsCollectionController extends Controller
{
    /**
     * @var GoodsCollectionRepository
     */
    protected $goodsCollection;

    /**
     * GoodsCollectionController constructor.
     * @param GoodsCollectionRepository $collectionRepository
     */
    public function __construct(GoodsCollectionRepository $collectionRepository)
    {
        $this->goodsCollection = $collectionRepository;
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
        // 判断是否登录
        if(empty(\Session::get('user'))) {
            return responseMsg('',401);
        }
        // 拼装参数
        $param['user_id'] = \Session::get('user')->user_id;
        $param['cargo_id'] = $request['cargo_id'];
        // 用户是否已经收藏该货品
        $exist = $this->goodsCollection->findUserForGoodsCollection($param);
        if(empty($exist)) {
            // 没有收藏添加，添加收藏记录
            $result = $this->goodsCollection->addOneGoodsCollection($param);

        } else {
            // 已经收藏 移除收藏
            $result = $this->goodsCollection->delOneGoodsCollection($exist->id);
        }
        // 判断操作是否成功
        if(!empty($result)) {
            // 操作成功  返回当前收藏总数
            $count = $this->goodsCollection->countGoodsCollection(['cargo_id'=>$param['cargo_id']]);
            return responseMsg($count,200);
        }
        // 失败 写入系统日志
        return responseMsg('操作失败',400);

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
