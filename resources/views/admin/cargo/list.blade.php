@extends('admin.layouts.master')

@section('title')
    货品列表
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            货品列表
                            <small class="pull-right"><a href="javascript: history.back();">返回</a></small>
                        </header>
                        <table class="table table-striped table-advance table-hover">
                            <thead>
                                <tr>
                                    <th>ID编号</th>
                                    <th>缩略图</th>
                                    <th>货品原价</th>
                                    <th>货品折扣价</th>
                                    <th>货品状态</th>
                                    <th>库存</th>
                                    <th>推荐位</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cargo">
                                    <td>@{{ item.id }}</td>
                                    <td><img :src="'{{ env('QINIU_DOMAIN') }}'+item.cargo_cover+'?imageView2/1/w/60/h/60'" alt="" width="60px"></td>
                                    <td>@{{ item.cargo_price }}</td>
                                    <td>@{{ item.cargo_discount }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" v-if="item.cargo_status == 1" title="待售"><i class="icon-truck"></i></button>
                                        <button class="btn btn-success btn-xs" v-if="item.cargo_status == 2" title="上架"><i class="icon-ok"></i></button>
                                        <button class="btn btn-danger btn-xs" v-if="item.cargo_status == 3" title="下架"><i class="icon-remove"></i></button>
                                    </td>
                                    <td>@{{ item.inventory }}</td>
                                    <td>@{{ recommendStr(item.recommends) }}</td>
                                    <td>
                                        <a href="#myModal-1" data-toggle="modal" :data-cid="item.id" class="btn btn-success btn-xs" title="选择推荐位" @click="getRecommend"><i class="icon-plus" :data-cid="item.id"></i></a>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </td>
                                </tr>
                                <tr v-if="!isData"><td colspan="8" class="text-center">暂无数据</td></tr>
                            </tbody>
                        </table>
                        <center v-if="isData">@include('common.page')</center>

                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
                             id="myModal-1" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                                            ×
                                        </button>
                                        <h4 class="modal-title">选择推荐位</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="recommend" class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="select-position"
                                                       class="col-lg-2 control-label">选择位置</label>
                                                <div class="col-lg-10">
                                                    <select class="form-control" id="select-position">
                                                        <option value="1">首页</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="select-name"
                                                       class="col-lg-2 control-label">选择名称</label>
                                                <div class="col-lg-10">
                                                    <div class="row">
                                                        <div class="col-lg-3" v-for="item in recommends">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input :checked="inArray(item.id)" type="checkbox" name="recommend_id[]" :value="item.id"> @{{ item.recommend_name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button type="button" class="btn btn-default" @click="selectRecommend">确 定</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@stop

@section('externalJs')
    <script src="{{ asset('admins/assets/jquery-knob/js/jquery.knob.js') }}"></script>
@stop

@section('customJs')
    <script>
        var goods_id = '{{ $id }}';
    </script>
    <script src="{{ asset('admins/handle/cargo/list.js') }}"></script>
@stop
