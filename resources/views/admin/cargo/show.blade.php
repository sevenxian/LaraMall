@extends('admin.layouts.master')

@section('title')
    货品添加
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
                            货品添加
                            <small class="pull-right"><a href="javascript: history.back();">返回</a></small>
                        </header>
                        <div class="panel-body">
                            <form id="cargo" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="category" class="col-md-1 control-label">商品分类</label>
                                    <div class="col-md-11">
                                        <p class="form-control-static" v-if="lv1s">@{{ lv1s.name }} &gt; @{{ lv2s.name }} &gt; @{{ lv3s.name }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goods_title" class="col-md-1 control-label">商品名称</label>
                                    <div class="col-md-11">
                                        <p class="form-control-static">@{{ goods.goods_title }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goods_title" class="col-md-1 control-label">货品原价</label>
                                    <div class="col-md-6">
                                        <input type="text" name="cargo_price" v-model="cargo_price" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goods_title" class="col-md-1 control-label">货品折扣价</label>
                                    <div class="col-md-6">
                                        <input type="text" name="cargo_discount" v-model="cargo_discount" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" v-for="(categoryLabel, index) in categoryLabels">
                                    <label for="category_label" class="col-md-1 control-label">@{{ categoryLabel.category_label_name }}</label>
                                    <div class="col-md-11">
                                        <div class="radios" style="padding-top: 8px;">
                                            <div class="row">
                                                <div class="col-md-3" v-for="attribute in categoryLabel.labels">
                                                    <label class="label_radio" @click="selectLabel">
                                                        <input :name="'categoryAttr'+(index+1)" :value="attribute.id" type="radio" />@{{ attribute.attribute_name }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row add">
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" placeholder="分类标签值">
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="button" class="btn btn-success btn-sm" :data-category_label_id="categoryLabel.id" :data-index="index" value="添加分类标签值" @click="addCategoryAttr">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" v-for="(goodsLabel, index) in goodsLabels">
                                    <label for="goods_label" class="col-md-1 control-label">@{{ goodsLabel.goods_label_name }}</label>
                                    <div class="col-md-11">
                                        <div class="radios" style="padding-top: 8px;">
                                            <div class="row">
                                                <div class="col-md-3" v-for="attribute in goodsLabel.labels">
                                                    <label class="label_radio" @click="selectLabel">
                                                    <input :name="'goodsAttr'+(index+1)" :value="attribute.id" type="radio" />@{{ attribute.goods_label_name }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row add">
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" placeholder="商品标签值">
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="button" class="btn btn-success btn-sm" :data-goods_label_id="goodsLabel.id" :data-index="index" value="添加商品标签值" @click="addGoodsAttr">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goods_original" class="col-md-1 control-label">货品图片</label>
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="col-xs-2 col-md-2" v-for="val in goodsImgs">
                                                <div class="thumbnail" style="cursor: pointer;">
                                                    <img src="/admins/img/goods_default.gif" @click="uploadGoodsImg">
                                                    <input type="file" style="display: none;">
                                                    <input type="hidden" name="goods_original[]" class="goods_original">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-success" style="margin-top: 15px;" @click="addGoodsImg">添加商品图片</button>
                                            </div>
                                        </div>
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
    <script>
        var QINIU_DOMAIN = '{{ env("QINIU_DOMAIN") }}';
        // 商品ID
        var goods_id = '{{ $id }}';
    </script>
    <script src="/admins/handle/cargo/show.js"></script>
    <!-- 页面表单验证 js -->
    <script src="/admins/handle/cargo/show_validation.js"></script>
@stop