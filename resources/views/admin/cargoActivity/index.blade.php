@extends('admin.layouts.master')

@section('title')
    活动列表
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            活动列表
                        </header>
                        {{--<div class="panel-body">--}}
                            {{--<form class="form-inline" role="form" @submit.prevent="searchList">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="sr-only" for="cargo_name">Email address</label>--}}
                                    {{--<input type="text" name="cargo_name" class="form-control" id="cargo_name" placeholder="货品名称">--}}
                                {{--</div>--}}
                                {{--<button type="submit" class="btn btn-success">搜索</button>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>ID编号</th>
                                    <th>货品名称</th>
                                    <th>活动名称</th>
                                    <th>活动时长</th>
                                    <th>促销价</th>
                                    <th>数量</th>
                                    <th>开始时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cargoActivitys">
                                    <td>@{{ item.id }}</td>
                                    <td><a :href="'/home/goodsDetail/'+item.cargo.id" target="_blank">@{{ item.cargo.cargo_name }}</a></td>
                                    <td>@{{ item.activity.name }}</td>
                                    <td>@{{ item.activity.length }}</td>
                                    <td>@{{ item.promotion_price }}</td>
                                    <td>@{{ item.number }}</td>
                                    <td>@{{ timeConvert(item.activity.start_timestamp) }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </td>
                                </tr>
                                <tr v-if="!isData"><td colspan="7" class="text-center">暂无数据</td></tr>
                            </tbody>
                        </table>
                        <center v-if="isData">@include('common.page')</center>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@stop

@section('customJs')
    <!-- 当前页面 js -->
    <script src="{{ asset('admins/handle/cargoActivity/index.js') }}"></script>
@stop
