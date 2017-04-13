@extends('admin.layouts.master')

@section('title')
    商品列表
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Inline form
                        </header>
                        <div class="panel-body">
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success">Sign in</button>
                            </form>

                        </div>
                    </section>

                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Inline form
                        </header>
                        <div class="panel-body">
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success">Sign in</button>
                            </form>

                        </div>
                    </section>
                    <section class="panel">
                        <header class="panel-heading">
                            商品列表 @{{ message }}
                        </header>
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
                                <tr>
                                    <td><a href="#">Vector Ltd</a></td>
                                    <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                    <td>12120.00$</td>
                                    <td><span class="label label-info label-mini">Due</span></td>
                                    <td>
                                        <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            Adimin co
                                        </a>
                                    </td>
                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                    <td>56456.00$</td>
                                    <td><span class="label label-warning label-mini">Due</span></td>
                                    <td>
                                        <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            boka soka
                                        </a>
                                    </td>
                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                    <td>14400.00$</td>
                                    <td><span class="label label-success label-mini">Paid</span></td>
                                    <td>
                                        <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                        <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
