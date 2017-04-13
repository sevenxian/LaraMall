@extends('admin.layouts.master')

@section('title')
    后台首页
@stop

@section('externalCss')
    <link href="/admins/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/admins/css/owl.carousel.css" type="text/css">
@stop

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!--state overview start-->
            <div class="row state-overview">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="icon-user"></i>
                        </div>
                        <div class="value">
                            <h1>22</h1>
                            <p>New Users</p>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol red">
                            <i class="icon-tags"></i>
                        </div>
                        <div class="value">
                            <h1>140</h1>
                            <p>Sales</p>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="icon-shopping-cart"></i>
                        </div>
                        <div class="value">
                            <h1>345</h1>
                            <p>New Order</p>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="icon-bar-chart"></i>
                        </div>
                        <div class="value">
                            <h1>34,500</h1>
                            <p>Total Profit</p>
                        </div>
                    </section>
                </div>
            </div>
            <!--state overview end-->

            <div class="row">
                <div class="col-lg-12">
                    <!--custom chart start-->
                    <div class="border-head">
                        <h3>Earning Graph</h3>
                    </div>
                    <div class="custom-bar-chart">
                        <div class="bar">
                            <div class="title">JAN</div>
                            <div class="value tooltips" data-original-title="80%" data-toggle="tooltip"
                                 data-placement="top">80%
                            </div>
                        </div>
                        <div class="bar doted">
                            <div class="title">FEB</div>
                            <div class="value tooltips" data-original-title="50%" data-toggle="tooltip"
                                 data-placement="top">50%
                            </div>
                        </div>
                        <div class="bar ">
                            <div class="title">MAR</div>
                            <div class="value tooltips" data-original-title="40%" data-toggle="tooltip"
                                 data-placement="top">40%
                            </div>
                        </div>
                        <div class="bar doted">
                            <div class="title">APR</div>
                            <div class="value tooltips" data-original-title="55%" data-toggle="tooltip"
                                 data-placement="top">55%
                            </div>
                        </div>
                        <div class="bar">
                            <div class="title">MAY</div>
                            <div class="value tooltips" data-original-title="20%" data-toggle="tooltip"
                                 data-placement="top">20%
                            </div>
                        </div>
                        <div class="bar doted">
                            <div class="title">JUN</div>
                            <div class="value tooltips" data-original-title="39%" data-toggle="tooltip"
                                 data-placement="top">39%
                            </div>
                        </div>
                        <div class="bar">
                            <div class="title">JUL</div>
                            <div class="value tooltips" data-original-title="75%" data-toggle="tooltip"
                                 data-placement="top">75%
                            </div>
                        </div>
                        <div class="bar doted">
                            <div class="title">AUG</div>
                            <div class="value tooltips" data-original-title="45%" data-toggle="tooltip"
                                 data-placement="top">45%
                            </div>
                        </div>
                        <div class="bar ">
                            <div class="title">SEP</div>
                            <div class="value tooltips" data-original-title="50%" data-toggle="tooltip"
                                 data-placement="top">50%
                            </div>
                        </div>
                        <div class="bar doted">
                            <div class="title">OCT</div>
                            <div class="value tooltips" data-original-title="42%" data-toggle="tooltip"
                                 data-placement="top">42%
                            </div>
                        </div>
                        <div class="bar ">
                            <div class="title">NOV</div>
                            <div class="value tooltips" data-original-title="60%" data-toggle="tooltip"
                                 data-placement="top">60%
                            </div>
                        </div>
                        <div class="bar doted">
                            <div class="title">DEC</div>
                            <div class="value tooltips" data-original-title="90%" data-toggle="tooltip"
                                 data-placement="top">90%
                            </div>
                        </div>
                    </div>
                    <!--custom chart end-->
                </div>
            </div>
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading"><font><font>
                               收益明细
                            </font></font></header>
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
                        <tr>
                            <td>
                                <a href="#"><font><font>
                                            博卡soka
                                        </font></font></a>
                            </td>
                            <td class="hidden-phone"><font><font>Lorem Ipsum dorolo</font></font></td>
                            <td><font><font>14400.00 $ </font></font></td>
                            <td><span class="label label-success label-mini"><font><font>付费</font></font></span></td>
                            <td>
                                <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#"><font><font>
                                            salbal llb
                                        </font></font></a>
                            </td>
                            <td class="hidden-phone"><font><font>Lorem Ipsum dorolo</font></font></td>
                            <td><font><font>2323.50 $ </font></font></td>
                            <td><span class="label label-danger label-mini"><font><font>付费</font></font></span></td>
                            <td>
                                <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#"><font><font>矢量有限公司</font></font></a></td>
                            <td class="hidden-phone"><font><font>Lorem Ipsum dorolo imit</font></font></td>
                            <td><font><font>12120.00 $ </font></font></td>
                            <td><span class="label label-primary label-mini"><font><font>到期</font></font></span></td>
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
                        <tr>
                            <td><a href="#"><font><font>矢量有限公司</font></font></a></td>
                            <td class="hidden-phone"><font><font>Lorem Ipsum dorolo imit</font></font></td>
                            <td><font><font>12120.00 $ </font></font></td>
                            <td><span class="label label-success label-mini"><font><font>到期</font></font></span></td>
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
            </div>

        </section>
    </section>
@stop

@section('coreJs')
    <script src="/admins/js/jquery.js"></script>
    <script src="/admins/js/jquery-1.8.3.min.js"></script>
    <script src="/admins/js/bootstrap.min.js"></script>
    <script src="/admins/js/jquery.scrollTo.min.js"></script>
    <script src="/admins/js/jquery.nicescroll.js" type="text/javascript"></script>
@stop

@section('externalJs')
    <script src="/admins/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="/admins/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/admins/js/owl.carousel.js"></script>
    <script src="/admins/js/jquery.customSelect.min.js"></script>
@stop

@section('customJs')
    <script src="/admins/js/sparkline-chart.js"></script>
    <script src="/admins/js/easy-pie-chart.js"></script>

    <script>

        //owl carousel

        $(document).ready(function () {
            $("#owl-demo").owlCarousel({
                navigation: true,
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true

            });
        });

        //custom select box

        $(function () {
            $('select.styled').customSelect();
        });

    </script>
@stop