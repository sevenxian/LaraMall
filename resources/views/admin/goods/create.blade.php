@extends('admin.layouts.master')

@section('title')
    添加商品
@stop

@section('externalCss')
    <link rel="stylesheet" type="text/css" href="/admins/assets/gritter/css/jquery.gritter.css"/>
    <link rel="stylesheet" type="text/css" href="/admins/assets/bootstrap-datepicker/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="/admins/assets/bootstrap-colorpicker/css/colorpicker.css"/>
    <link rel="stylesheet" type="text/css" href="/admins/assets/bootstrap-daterangepicker/daterangepicker.css"/>
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            商品添加
                        </header>
                        <div class="panel-body">
                            <div class="alert alert-success alert-block fade in">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Best check yo self, you're not looking too good...</p>
                            </div>
                            <form id="goods" class="form-horizontal" role="form" @submit.prevent="addGoods">
                                <div class="form-group">
                                    <label for="inputGoodsTitle" class="col-md-1 control-label">商品分类</label>
                                    <div class="col-md-11" id="category">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-control" v-model="level1" @change="lv1">
                                                <option :value="level.id" v-for="level in lv1s">@{{ level.name }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" v-model="level2" @change="lv2">
                                                <option :value="level.id" v-for="level in lv2s">@{{ level.name }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" v-model="level3" @change="lv3">
                                                    <option :value="level.id" v-for="level in lv3s">@{{ level.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputGoodsTitle" class="col-md-1 control-label">商品名称</label>
                                    <div class="col-md-11">
                                        <input type="text" name="goods_title" class="form-control" id="inputGoodsTitle" placeholder="商品名称">
                                    </div>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label for="inputGoodsTitle" class="col-md-1 control-label">商品名称</label>--}}
                                    {{--<div class="col-md-11">--}}
                                        {{--<input name="tagsinput" id="tagsinput" class="tagsinput"--}}
                                               {{--value="Flat,Design,Lab,Clean"/>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="inputPassword1" class="col-md-1 control-label">Password</label>--}}
                                    {{--<div class="col-md-11">--}}
                                        {{--<input type="password" class="form-control" id="inputPassword1"--}}
                                               {{--placeholder="Password">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<div class="col-md-offset-1 col-md-11">--}}
                                        {{--<div class="checkbox">--}}
                                            {{--<label>--}}
                                                {{--<input type="checkbox"> Remember me--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <div class="col-md-offset-1 col-md-11">
                                        <button type="submit" class="btn btn-danger">确 定</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@stop

@section('externalJs')
    <script src="/admins/js/jquery-ui-1.9.2.custom.min.js"></script>
    <!--custom switch-->
    <script src="/admins/js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="/admins/js/jquery.tagsinput.js"></script>
    <!--custom checkbox & radio-->
    <script type="text/javascript" src="/admins/js/ga.js"></script>
    <script type="text/javascript" src="/admins/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/admins/assets/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="/admins/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="/admins/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/admins/assets/gritter/js/jquery.gritter.js"></script>
@stop

@section('customJs')
    <!--当前页面 js-->
    <script src="/admins/js/form-component.js"></script>
    <script src="/admins/js/gritter.js" type="text/javascript"></script>
    <script src="/admins/handle/goods/create.js"></script>
    <!-- 页面表单验证 js -->
    {{--<script src="/admins/handle/goods/create_validation.js"></script>--}}
@stop