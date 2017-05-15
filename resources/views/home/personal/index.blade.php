@extends('home.layouts.master')

@section('title')
    个人中心
@stop

@section('externalCss')
    <link href="/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/css/systyle.css" rel="stylesheet" type="text/css">
@stop

@section('header')
    @include('home.public.header')
@stop

@section('nav')
    @include('home.public.navTab')
@stop

@section('content')
    <div class="center">
        <div class="col-main">
            <div class="main-wrap">
                <div class="wrap-left">
                    <div class="wrap-list">
                        <div class="m-user">
                            <!--个人信息 -->
                            <div class="m-bg"></div>
                            <div class="m-userinfo">
                                <div class="m-baseinfo">
                                    <a href="javascript:;">

                                        <img src="@if(empty(\Session::get('userInfo')->avatar))/images/getAvatar.do.jpg @else {{ env('QINIU_DOMAIN') }}{{ \Session::get('userInfo')->avatar }}  @endif">
                                    </a>
                                    <em class="s-name">{{ \Session::get('userInfo')->nickname }}<span class="vip1"></span></em>

                                </div>
                                <div class="m-right">
                                    <div class="m-address">
                                        <a href="address.html" class="i-trigger">我的收货地址</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-container-bottom"></div>

                        <!--订单 -->
                        <div class="m-order">
                            <div class="s-bar">
                                <i class="s-icon"></i>我的订单
                                <a class="i-load-more-item-shadow" href="order.html">全部订单</a>
                            </div>
                            <ul>
                                <li><a href="order.html"><i><img src="/images/pay.png"/></i><span>待付款</span></a></li>
                                <li><a href="order.html"><i><img src="/images/send.png"/></i><span>待发货<em
                                                    class="m-num">1</em></span></a></li>
                                <li><a href="order.html"><i><img src="/images/receive.png"/></i><span>待收货</span></a></li>
                                <li><a href="order.html"><i><img src="/images/comment.png"/></i><span>待评价<em
                                                    class="m-num">3</em></span></a></li>
                                <li><a href="change.html"><i><img src="/images/refund.png"/></i><span>退换货</span></a></li>
                            </ul>
                        </div>
                        <!--九宫格-->
                        <div class="user-patternIcon">
                            <div class="s-bar">
                                <i class="s-icon"></i>我的常用
                            </div>
                            <ul>

                                <a href="/home/shopcart.html">
                                    <li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img
                                                src="/images/iconbig.png"/>
                                        <p>购物车</p></li>
                                </a>
                                <a href="collection.html">
                                    <li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img
                                                src="/images/iconsmall1.png"/>
                                        <p>我的收藏</p></li>
                                </a>
                                <a href="/home/home.html">
                                    <li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img
                                                src="/images/iconsmall0.png"/>
                                        <p>为你推荐</p></li>
                                </a>
                                <a href="comment.html">
                                    <li class="am-u-sm-4"><i class="am-icon-pencil am-icon-md"></i><img
                                                src="/images/iconsmall3.png"/>
                                        <p>好评宝贝</p></li>
                                </a>
                                <a href="foot.html">
                                    <li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img
                                                src="/images/iconsmall2.png"/>
                                        <p>我的足迹</p></li>
                                </a>
                            </ul>
                        </div>



                        <!--收藏夹 -->
                        <div class="you-like">
                            <div class="s-bar">我的收藏
                            </div>
                            <div class="s-content">

                              @if(!empty($data))
                                @foreach($data as $item)
                                <div class="s-item-wrap">
                                    <div class="s-item">

                                        <div class="s-pic">
                                            <a href="#" class="s-pic-link">
                                                <img src="{{ env('QINIU_DOMAIN') }}{{ $item['cargo_cover'] }}" alt="{{ $item['cargo_name'] }}" title="{{ $item['cargo_name'] }}" class="s-pic-img s-guess-item-img">
                                                @if($item['cargo_status'] == 3)<span class="tip-title">已下架</span>@endif
                                            </a>
                                        </div>
                                        <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em
                                                    class="s-value">{{ $item['cargo_discount'] }}</em></span>
                                        <span class="s-history-price"><em class="s-price-sign">¥</em><em
                                                    class="s-value">{{ $item['cargo_price'] }}</em></span>

                                        </div>
                                        <div class="s-title"><a href="#" title="{{ $item['cargo_name'] }}">{{ $item['cargo_name'] }}</a>
                                        </div>
                                        <div class="s-extra-box">
                                            <span class="s-comment">好评: 98.03%</span>
                                            <span class="s-sales">月销: 219</span>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                             @endif

                            </div>

                          {{--  <div class="s-more-btn i-load-more-item" data-screen="0"><i
                                        class="am-icon-refresh am-icon-fw"></i>页数
                            </div>--}}

                            @if(!$page->isEmpty())
                                <div class="am-pagination" style="text-align:center">
                                    {{ $page->render() }}
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
                <div class="wrap-right">

                    <!-- 日历-->
                    <div class="day-list">
                        <div class="s-bar">
                            <a class="i-history-trigger s-icon" href="#"></a>我的日历
                            <a class="i-setting-trigger s-icon" href="#"></a>
                        </div>
                        <div class="s-care s-care-noweather">
                            <div class="s-date">
                                <em>21</em>
                                <span>星期一</span>
                                <span>2015.12</span>
                            </div>
                        </div>
                    </div>
                    <!--新品 -->
                    <div class="new-goods">
                        <div class="s-bar">
                            <i class="s-icon"></i>今日新品
                            <a class="i-load-more-item-shadow">15款新品</a>
                        </div>
                        <div class="new-goods-info">
                            <a class="shop-info" href="#" target="_blank">
                                <div class="face-img-panel">
                                    <img src="/images/imgsearch1.jpg" alt="">
                                </div>
                                <span class="new-goods-num ">4</span>
                                <span class="shop-title">剥壳松子</span>
                            </a>
                            <a class="follow " target="_blank">关注</a>
                        </div>
                    </div>

                    <!--热卖推荐 -->
                    <div class="new-goods">
                        <div class="s-bar">
                            <i class="s-icon"></i>热卖推荐
                        </div>
                        <div class="new-goods-info">
                            <a class="shop-info" href="#" target="_blank">
                                <div>
                                    <img src="/images/imgsearch1.jpg" alt="">
                                </div>
                                <span class="one-hot-goods">￥9.20</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <!--底部-->
            <div class="footer">
                <div class="footer-hd">
                    <p>
                        <a href="#">恒望科技</a>
                        <b>|</b>
                        <a href="#">商城首页</a>
                        <b>|</b>
                        <a href="#">支付宝</a>
                        <b>|</b>
                        <a href="#">物流</a>
                    </p>
                </div>
                <div class="footer-bd">
                    <p>
                        <a href="#">关于恒望</a>
                        <a href="#">合作伙伴</a>
                        <a href="#">联系我们</a>
                        <a href="#">网站地图</a>
                        <em>© 2015-2025 Hengwang.com 版权所有</em>
                    </p>
                </div>
            </div>

        </div>

        @include('home.public.aside')
    </div>
    @include('home.public.navCir')
@stop