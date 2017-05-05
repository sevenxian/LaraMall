<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * @var ActivityRepository
     * @author zhulinjie
     */
    protected $activity;

    /**
     * ActivityController constructor.
     * @param ActivityRepository $activityRepository
     */
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activity = $activityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.activity.index');
    }

    /**
     * 获取活动列表数据
     *
     * @param Request $request
     * @return mixed
     * @author zhulinjie
     */
    public function activityList(Request $request)
    {
        $data = $request->all();

        // 获取活动列表
        $res = $this->activity->paging($data['where'], $data['perPage']);

        // 判断商品是否存在
        if(empty($res)){
            return responseMsg('暂无数据', 404);
        }

        return responseMsg($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->all();

        $data['name'] = $req['name'];
        $data['desc'] = $req['desc'];
        $data['type'] = $req['type'];
        $data['start_timestamp'] = strtotime($req['start_timestamp']);
        $data['length'] = $req['length'];
        $data['end_timestamp'] = $data['start_timestamp'] + $data['length'] * 60;

        $res = $this->activity->insert($data);

        if(!$res){
            return responseMsg('添加活动失败', 400);
        }

        return responseMsg('添加活动成功');
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
