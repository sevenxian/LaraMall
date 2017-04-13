@extends('admin.layouts.master')

@section('title')
    商品列表
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            商品列表
                        </header>
                        <div class="panel-body">
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                    <input type="text" name="goods_title" class="form-control" id="exampleInputEmail2" v-model="search" placeholder="商品名称">
                                </div>
                                <button type="submit" @click.prevent="searchList" class="btn btn-success">搜索</button>
                            </form>
                        </div>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th><i class="icon-bullhorn"></i> 商品名称</th>
                                    <th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>
                                    <th><i class="icon-bookmark"></i> Profit</th>
                                    <th><i class=" icon-edit"></i> Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in datas">
                                    <td><a href="#">@{{ data.goods_title }}</a></td>
                                    <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                    <td>12120.00$</td>
                                    <td><span class="label label-info label-mini">Due</span></td>
                                    <td>
                                        <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
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
    <script src="{{ asset('admins/handle/goods/index.js') }}"></script>
@stop
