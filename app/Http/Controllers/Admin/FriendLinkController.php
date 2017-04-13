<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FriendLinkController extends Controller
{
    /**
     * 友情链接管理页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author wutao
     */
    public function index()
    {
        return view('admin.links.link');
    }
    /**
     * 添加友情链接
     *
     * @author  wutao
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        dd($data);
        $data = DB::table('data_friend_link')->insert($data);
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
