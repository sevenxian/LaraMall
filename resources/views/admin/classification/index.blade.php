@extends('admin.layouts.master')

@section('title')
    FlatLab - Flat & Responsive Bootstrap Admin Template
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            分类列表：@{{ getLevel(currentLevel) }}
                        </header>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                            <tr>
                                <th><i class="icon-bullhorn"></i> id</th>
                                <th class="hidden-phone"><i class="icon-question-sign"></i> 分类名称</th>
                                <th><i class="icon-bookmark"></i> 父级分类</th>
                                <th><i class=" icon-edit"></i> 操作</th>
                                <th><i class=" icon-bookmark"></i> 子类操作</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(data, index) in datas">
                                <td>@{{ data.id }}</td>
                                <td>@{{ data.name }}</td>
                                <td>@{{ data.name }}</td>
                                <td><span class="label label-info label-mini">修改</span></td>
                                <td>
                                    <button class="btn btn-primary btn-xs"><i class="icon-eye-open"></i></button>
                                    <button class="btn btn-success btn-xs"><i class="icon-plus"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <center>@include('common.page')</center>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@stop

@section('customJs')
    <!-- 当前页面 js -->
    <script src="{{ asset('admins/handle/classification/index.js') }}"></script>
@stop