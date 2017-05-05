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
                        <div class="panel-body">
                            <form class="form-inline" role="form" @submit.prevent="searchList">
                                <div class="form-group">
                                    <label class="sr-only" for="name">Email address</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="活动名称">
                                </div>
                                <button type="submit" class="btn btn-success">搜索</button>
                            </form>
                        </div>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>ID编号</th>
                                    <th>活动名称</th>
                                    <th>类型</th>
                                    <th>活动时长</th>
                                    <th>开始时间</th>
                                    <th>结束时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in activitys">
                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>
                                        <template v-if="item.type == 1">秒杀</template>
                                        <template v-if="item.type == 2">特惠</template>
                                        <template v-if="item.type == 3">团购</template>
                                        <template v-if="item.type == 4">超值</template>
                                    </td>
                                    <td>@{{ item.length }}</td>
                                    <td>@{{ timeConvert(item.start_timestamp) }}</td>
                                    <td>@{{ timeConvert(item.end_timestamp) }}</td>
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
    <script src="{{ asset('admins/handle/activity/index.js') }}"></script>
@stop
