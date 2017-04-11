<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserLoginRequest;
use App\Repositories\UsersLoginRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var
     */
    protected $users;

    /**
     * UserController constructor.
     * @param $users
     */
    public function __construct(UsersLoginRepository $users)
    {
        $this->users = $users;
    }

    /**
     * 后台登录
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function login()
    {
        return view('admin.login');
    }

    public function store(UserLoginRequest $request)
    {
        dd($request->all());
    }
}
