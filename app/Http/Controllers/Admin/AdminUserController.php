<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Repositories\AdminUserRepository;
use App\Repositories\RoleRepository;
use App\Tools\Common;
use App\Tools\LogOperation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


/**
 * Class AdminUserController
 * @package App\Http\Controllers\Admin
 */
class AdminUserController extends Controller
{
    /**
     * @var AdminUserRepository
     */
    protected $adminUser;
    /**
     * @var LogOperation
     * @author zhangyuchao
     */
    protected $log;

    /**
     * @var Role
     * @author Luoyan
     */
    protected $role;

    /**
     * AdminUserController constructor.
     * @param AdminUserRepository $adminUser
     * @param LogOperation $logOperation
     * @param RoleRepository $roleRepository
     * @author zhangyuchao
     */
    public function __construct
    (
        AdminUserRepository $adminUser,
        LogOperation $logOperation,
        RoleRepository $roleRepository
    )
    {
        $this->adminUser = $adminUser;
        $this->log = $logOperation;
        $this->role = $roleRepository;
    }

    /**
     * 返回模板视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhangyuchao
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @author zhangyuchao
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * 同步用户角色
     *
     * @param Request $request
     * @param $id
     * @author: Luoyan
     */
    public function syncRoles(Request $request, $id)
    {
        // 查询当前角色
        $user = $this->adminUser->getOneData(['id' => $id]);
        // 同步角色权限
        $user->syncRoles($request->all());
    }

    /**
     * 添加管理员操作
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author zhangyuchao
     */
    public function store(Request $request)
    {

        // 密码判断
        if ($request['password'] != $request['rel_password']) return responseMsg('两次密码输入不一致', 400);
        // 判断手机号码是否存在
        $tel = $this->adminUser->getOneData(['tel' => $request['tel']]);
        if (!empty($tel)) return responseMsg('手机号码已存在', 400);
        // 数据处理
        $param['password'] = bcrypt(trim($request['password']));
        $param['tel'] = trim($request['tel']);
        $param['nickname'] = trim($request['nickname']);
        // 插入数据
        $result = $this->adminUser->createByUser($param);
        // 数据插入失败 返回错误信息
        if (!$result) return responseMsg('添加失败', 400);
        // 成功返回正确信息，组装数据，返回到前台,使用vue 添加到列表里
        $data = $result->toArray();
        $data['address'] = '从未登录';
        $data['last_login_at'] = $data['created_at'];
        // 组装操作日志内容
        $message = Common::logMessageForInside
        (
            auth('admin')->user()->id,  // 管理员ID
            auth('admin')->user()->nickname, // 管理员昵称
            $request->getClientIp(),
            $request->url(),
            $request->all(),
            config('log.adminLog')[2]
        );
        // 填写操作日志
        $this->log->writeAdminLog($message);

        return responseMsg($data);
    }

    /**
     * 获取用户角色列表
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: Luoyan
     */
    public function show($id)
    {
        // 获取所有权限
        $roles = $this->role->fetchRoles();
        // 判断是否有权限数据
        if (!$roles->toArray()) {
            // 暂无权限
            return responseMsg([]);
        }
        // 查询角色已有权限
        $ids = $this->adminUser->fetchRolesTheIds($id)->toArray();
        // 判断该角色是否有权限
        if (!$ids) {
            // 返回所有权限
            return responseMsg($roles);
        }

        // 给已有的权限打个标记
        foreach ($roles as $v) {
            if (in_array($v->id, $ids)) {
                $v->checked = true;
            }
        }

        // 返回权限列表数据
        return responseMsg($roles);
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
     * 管理员密码重置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function update(Request $request)
    {
        // 参数判断
        $password = trim($request['password']);
        if (empty($request['id'])) return responseMsg('非法操作', 400);
        // 密码判断
        if ($password != $request['rel_password']) return responseMsg('两次密码输入不一致', 400);
        // 查询单挑数据 判断密码是否更新
        $data = $this->adminUser->getOneData(['id' => $request['id']]);
        // 检测原始密码与新密码
        if (Hash::check($password, $data->password)) {

            return responseMsg('新密码与原始密码一致', 400);
        }
        // 数据操作
        $result = $this->adminUser->updateOneData(['id' => $request['id']], ['password' => bcrypt($password)]);
        if (empty($result)) return responseMsg('更新失败', 400);

        return responseMsg('重置密码成功', 200);
    }

    /**
     * 删除操作
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function destroy($id)
    {
        // 参数验证
        if (empty($id)) return responseMsg('非法操作', 400);
        $result = $this->adminUser->deleteOneData($id);
        // 数据判断
        if (empty($result)) return responseMsg('删除失败', 400);

        return responseMsg('删除成功');
    }

    /**
     * 获取管理员列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author zhangyuchao
     */
    public function userList(Request $request)
    {
        // 判断搜索条件
        switch ($request['where']['type']) {
            case 1:
                $where['nickname'] = trim($request['where']['value']);
                break;
            case 2:
                $where['tel'] = trim($request['where']['value']);
                break;
            default:
                $where = [];
                break;
        }
        // 获取列表数据
        $result = $this->adminUser->getAllData($where, $request['perPage']);
        // 数据是否获取成功
        if (empty($result)) return responseMsg('', 400);

        return responseMsg($result);
    }
}
