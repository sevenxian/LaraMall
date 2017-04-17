<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\IndexUserLoginRepository;
use App\Repositories\RegisterRepository;
use App\Tools\LogOperation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    /**
     * @var RegisterRepository
     */
    protected $registerUser;
    /**
     *
     */
    protected $indexUserLogin;


    public function __construct(RegisterRepository $registerRepository,IndexUserLoginRepository $indexUserLoginRepository)
    {
        $this->registerUser = $registerRepository;
        $this->indexUserLogin = $indexUserLoginRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.subscribers.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.subscribers.details');
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


    public function update(Request $request)
    {
        // 参数判断
        $password = trim($request['password']);
        if (empty($request['id'])) return responseMsg('非法操作', 400);
        // 密码判断
        if ($password != $request['rel_password']) return responseMsg('两次密码输入不一致', 400);
        // 查询单挑数据 判断密码是否更新
        $data = $this->indexUserLogin->findOneUserManner(['user_id'=>$request['id']]);
        // 检测原始密码与新密码
        if (Hash::check($password, $data->password)) {
            return responseMsg('新密码与原始密码一致', 400);
        }
        // 数据操作
        $result = $this->indexUserLogin->updateUserManner(['user_id'=>$request['id']],['password' => $request['password']]);
        if (empty($result)) return responseMsg('更新失败', 400);
        return responseMsg('重置密码成功', 200);
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

    public function subscriberList(Request $request)
    {
        // 判断搜索条件
        switch ($request['where']['type']) {
            case 1:
                $where['tel'] = trim($request['where']['value']);
                break;
            case 2:
                $where['email'] = trim($request['where']['value']);
                break;
            default:
                $where = [];
                break;
        }

        $result = $this->registerUser->getUserList($where,$request['perPage']);

        if(empty($result)) return responseMsg('', 400);

        return responseMsg($result,200);
    }
}
