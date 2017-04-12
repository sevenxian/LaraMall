@extends('admin.layouts.master')

@section('title')
    FlatLab - Flat & Responsive Bootstrap Admin Template
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- 模态框 start -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">修改分类</h4>
                        </div>
                        <form id="formCategory" method="post"  @submit.prevent="submit(category.id, $event)">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">分类名称:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="name"
                                           :value="category.name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">描述:</label>
                                    <input type="text" class="form-control" name="describe" :value="category.describe">
                                </div>
                                <div class="form-group">
                                    <label for="curl" class="control-label col-lg-2">图片</label>
                                    <label for="img"><img width="100px" class="img-responsive" id="img_img"
                                                          :src="(category.img != null) ? category.doma + category.img : 'https://dn-phphub.qbox.me/uploads/images/201704/11/4430/U0ctyGJUV7.png'"></label>
                                    <input id="img" style="display: none" type="file" class="form-control"
                                           name="image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 模态框 end -->
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
                                <th> id</th>
                                <th> 分类名称</th>
                                <th> 父级分类</th>
                                <th> 操作</th>
                                <th> 子类操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(data, index) in datas">
                                <td>@{{ data.id }}</td>
                                <td>@{{ data.name }}</td>
                                <td>@{{ (data.parent_category != null)?data.parent_category.name:'顶级分类' }}</td>
                                <td>
                                    <button @click="fetchCategoryById(data.id, index)" class="btn btn-info btn-xs"
                                            data-toggle="modal" data-target="#exampleModal"
                                            data-whatever="@getbootstrap">修改
                                    </button>
                                </td>
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
    <!-- 当前页面表单验证 js -->
    <script src="{{ asset('admins/handle/classification/index_form_validation.js') }}"></script>
@stop