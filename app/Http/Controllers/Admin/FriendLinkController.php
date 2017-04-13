<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FriendLinkController extends Controller
{
    /**
     * 返回友情链接模板视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author wutao
     */
    public function index()
    {
        return view('admin.links.link');
    }

    /**
     *  添加友情链接模板
     *
     * @author wutao
     */
    public function create()
    {
        return view('admin.links.create');
    }
    /**
     * 添加友情链接
     *
     * @author  wutao
     */
    public function store(Request $request)
    {
        $message ='aaaa';
        return responseMsg($message,200);
        dd($request);
        // 插入数据
        $result = $this->friendLink->createByUser($param);

        // 数据插入失败 返回错误信息
        if(!$result)  return responseMsg('添加失败',400);
    }
    /**
     * 修改友情链接
     *
     * @author  wutao
     */
     public function update($id,Request $request)
     {

     }
    /**
     * 删除友情链接
     *
     * @author  wutao
     */
    public function destory($id)
    {

    }
}
