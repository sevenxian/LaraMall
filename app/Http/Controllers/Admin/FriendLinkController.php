<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\FriendLink;
use Illuminate\Http\Request;
use App\Repositories\FriendLinkRepository;

class FriendLinkController extends Controller
{
    /**
     * @var FriendLinkRepository
     */
    protected $friendLink;

    /**
     * AdminUserController constructor.
     * @param AdminUserRepository $adminUser
     * @author wutao
     */
    public function __construct(FriendLinkRepository $friendLink)
    {
        $this->friendLink = $friendLink;
    }
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
     * 添加友情链接
     *
     * @author  wutao
     */
    public function store(Request $request)
    {
        //数据插入成功 返回成功信息
        if(empty($request['name'])) return responseMsg('名称不能为空','400');
        if(empty($request['url'])) return responseMsg('链接地址不能为空','400');
        $result = $this->friendLink->createByCategory($request->all());
        if (!empty($result)) {
            return responseMsg('添加成功', 200);
            // 录入成功跳转
        }else{
            return responseMsg('添加失败',400);
        }
        // 数据插入失败 返回错误信息
    }
    /**
     * 修改友情链接
     *
     * @author  wutao
     */
     public function update(Request $request)
     {
         // 修改单条数据
         if(empty($request['name'])) return responseMsg('名称不能为空','400');
         if(empty($request['url'])) return responseMsg('链接地址不能为空','400');
         $data = $this->friendLink->updateOneData(['id' => $request['id']],$request->only('name','image','url'));
         if(!empty($data)){
             return responseMsg('修改成功', 200);
         }else{
             return responseMsg('修改失败', 400);
         }
     }
    /**
     * 删除友情链接
     *
     * @author  wutao
     */
    public function destroy($id)
    {
        // 参数验证
        if(empty($id)) return responseMsg('非法操作',400);
        $result = $this->friendLink->deleteOneData($id);
        // 数据判断
        if(empty($result)) return responseMsg('删除失败',400);

        return responseMsg('删除成功');
    }

    /**
     * 获取友情链接列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author wutao
     */
    public function linkList(Request $request)
    {
        // 判断搜索条件
        $where['name'] = trim($request['where']['value']);
        // 判断是否搜索
        if(!empty($where['name'])){
            //获取搜索的数据
            $result = $this->friendLink->getManyData($where , $request['perPage']);
        }else {
            // 获取全部列表数据
            $result = $this->friendLink->getAllData($request['perPage']);
        }
        // 数据是否获取成功
        if(!empty($result)) return responseMsg($result,200);

        return responseMsg($result,400);
    }
}
