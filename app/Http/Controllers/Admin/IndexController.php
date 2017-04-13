<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 后台首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function index()
    {
        return view('admin.index');
    }
}
