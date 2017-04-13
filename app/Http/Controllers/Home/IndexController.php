<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 商城首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author zhulinjie
     */
    public function index()
    {
        return view('home.index');
    }
}
