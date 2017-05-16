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
                            <h1>@</h1>
                            <p>用户总数量</p>
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
                        <h3>数据统计</h3>
                    </div>
                    <div>
                        <div id="user"  class="col-lg-6" style="height:300px;"></div>
                        <div id="order"  class="col-lg-6" style="height:300px;"></div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('customJs')
    <script> var token = "{{ csrf_token() }}" </script>
    <script src="{{ asset('/admins/handle/index/index.js') }}"></script>
    <script src="{{ asset('/admins/js/echarts.common.min.js') }}"></script>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var userChart = echarts.init(document.getElementById('user'));
        var orderChart = echarts.init(document.getElementById('order'));

        function getUser(){
            option = {
                title : {
                    text: '注册方式统计',
                    subtext: 'LAMP兄弟连教学使用',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ['手机注册','邮箱注册']
                },
                series : [
                    {
                        name: '注册方式',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[
                            {value:35, name:'手机注册'},
                            {value:66, name:'邮箱注册'},
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };

            return option
        }
        userChart.setOption(getUser());
        //orderChart.setOption(option);
    </script>
@stop