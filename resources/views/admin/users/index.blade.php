@extends('admin.layouts.master')
@section('title','管理员列表')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading" style="padding: 15px;">
                    <font><font>
                            管理员列表
                        </font></font>
                    <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">添加管理员</button>

                </header>

                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th><i class="icon-bullhorn"></i><font><font> 公司</font></font></th>
                        <th class="hidden-phone"><i class="icon-question-sign"></i><font><font> 消耗</font></font></th>
                        <th><i class="icon-bookmark"></i><font><font> 利润</font></font></th>
                        <th><i class=" icon-edit"></i><font><font> 状态</font></font></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a href="#"><font><font>矢量有限公司</font></font></a></td>
                        <td class="hidden-phone"><font><font>Lorem Ipsum dorolo imit</font></font></td>
                        <td><font><font>12120.00 $ </font></font></td>
                        <td><span class="label label-info label-mini"><font><font>到期</font></font></span></td>
                        <td>
                            <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                            <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                            <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"><font><font>
                                        Adimin公司
                                    </font></font></a>
                        </td>
                        <td class="hidden-phone"><font><font>Lorem Ipsum dorolo</font></font></td>
                        <td><font><font>56456.00 $ </font></font></td>
                        <td><span class="label label-warning label-mini"><font><font>到期</font></font></span></td>
                        <td>
                            <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                            <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                            <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">添加管理员</h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">用户名:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="nickname">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">手机号码:</label>
                                        <input type="text" class="form-control" name="tel">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">密码:</label>
                                        <input type="password" class="form-control"  name="password" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">确认密码:</label>
                                        <input type="password" class="form-control"  name="rel_password" id="">

                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="button" class="btn btn-primary">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </section>
@endsection