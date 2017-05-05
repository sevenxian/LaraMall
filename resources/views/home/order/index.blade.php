@extends('home.layouts.master')

@section('title')
    订单支付
@stop

@section('externalCss')
    <link href="/basic/css/demo.css" rel="stylesheet" type="text/css"/>
    <link href="/css/cartstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/css/jsstyle.css" rel="stylesheet" type="text/css"/>
@stop

@section('header')
    @include('home.public.header')
@stop

@section('content')
    <div class="concent">
        <!--地址 -->
        <div class="paycont">
            <div class="address">
                <h3>确认收货地址 </h3>
                <div class="control selected">
                    <div class="tc-btn createAddr theme-login am-btn am-btn-danger"><a href="{{ url('/home/address/create') }}" style="color:#fff">添加新地址</a></div>
                </div>
                <div class="clear"></div>
                <ul>
                    @if(!empty($data['address']))
                        @foreach($data['address'] as $key => $val)
                            <div class="per-border"></div>
                        <li class="user-addresslist  @if($val->status == 2) defaultAddr @endif" data-address-id="{{ $val->id }}">

                            <div class="address-left">
                                <div class="user @if($val->status == 2) defaultAddr @endif">

                                            <span class="buy-address-detail">
                       <span class="buy-user">{{ $val->consignee }}</span>
                                            <span class="buy-phone">{{ $val->tel }}</span>
                                            </span>
                                </div>
                                <br>
                                <div class="@if($val->status == 2) default-address DefaultAddr @endif">
                                    <span class="buy-line-title buy-line-title-type">收货地址：</span>
                                    <span class="buy--address-detail">
                                       <span class="province">{{ $val->province }}</span>
                                            <span class="city">{{ $val->city }}</span>
                                            <span class="dist">{{ $val->county }}</span>
                                            <span class="street">{{  $val->detailed_address }}</span>
                                            </span>


                                </div>
                                @if($val->status == 2)
                                <ins class="deftip" style="background: #ee3495">默认地址</ins>
                                @endif
                            </div>
                            <div class="address-right">
                                <a href="../person/address.html">
                                    <span class="am-icon-angle-right am-icon-lg"></span></a>
                            </div>
                            <div class="clear"></div>

                            <div class="new-addr-btn">
                                <a href="{{ url('/home/address') }}/{{ $val->id }}/edit">编辑</a>
                            </div>

                        </li>
                        @endforeach
                    @endif
                </ul>

                <div class="clear"></div>
            </div>
            <!--支付方式-->
            <div class="logistics">
                <h3>选择支付方式</h3>
                <ul class="pay-list">
                    <li class="pay qq" data-pay-type="1"><img src="/images/weizhifu.jpg">微信<span></span></li>
                    <li class="pay taobao selected" data-pay-type="2"><img src="/images/zhifubao.jpg">支付宝<span></span></li>
                </ul>
            </div>
            <div class="clear"></div>

            <!--订单 -->
            <div class="concent">
                <div id="payTable">
                    <h3>确认订单信息</h3>
                    <div class="cart-table-th">
                        <div class="wp">

                            <div class="th th-item">
                                <div class="td-inner">商品信息</div>
                            </div>
                            <div class="th th-price">
                                <div class="td-inner">单价</div>
                            </div>
                            <div class="th th-amount">
                                <div class="td-inner">数量</div>
                            </div>
                            <div class="th th-sum">
                                <div class="td-inner">金额</div>
                            </div>
                            <div class="th th-oplist">
                                <div class="td-inner">优惠金额</div>
                            </div>

                        </div>
                    </div>
                    <div class="clear"></div>

                    @if(!empty($data['goods']))
                        @foreach($data['goods'] as $key => $value)
                    <div class="bundle  bundle-last">

                        <div class="bundle-main">
                            <ul class="item-content clearfix" data-cargo-id="{{ $value['id'] }}" data-goods-id ="{{ $value['goods_id'] }}">
                                <div class="pay-phone">
                                    <li class="td td-item">
                                        <div class="item-pic">
                                            <a href="#" class="J_MakePoint">
                                                <img src="{{ env('QINIU_DOMAIN') }}{{ $value['cargo_cover'] }}?imageView2/1/w/80/h/80" class="itempic J_ItemImg"></a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-basic-info">
                                                <a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $value['cargo_name'] }}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-info">
                                        <div class="item-props">
                                            @if(!empty($value['label']))
                                                @foreach($value['label'] as $v)
                                                <span class="sku-line">{{ $v['label_name'] }}:{{ $v['attr_name'] }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </li>
                                    <li class="td td-price">
                                        <div class="item-price price-promo-promo">
                                            <div class="price-content">
                                                <div class="price-content">
                                                    <div class="price-line">
                                                        <em class="price-original">{{ $value['cargo_price']  }}</em>
                                                    </div>
                                                    <div class="price-line">
                                                        <em class="J_Price price-now" tabindex="0">{{ $value['cargo_discount'] }}</em>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                                <li class="td td-amount">
                                    <div class="amount-wrapper ">
                                        <div class="item-amount ">
                                            <span class="phone-title">购买数量</span>
                                            <div class="sl">{{ $value['shopping_number'] }} </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-sum">
                                    <div class="td-inner">
                                        <em tabindex="0" class="J_ItemSum number">{{ $value['shopping_number'] * $value['cargo_discount'] }}</em>
                                    </div>
                                </li>
                                <li class="td td-oplist">
                                    <div class="td-inner">
                                        {{ ($value['cargo_price'] * $value['shopping_number']) - ($value['shopping_number'] * $value['cargo_discount']) }}
                                    </div>
                                </li>

                            </ul>
                            <div class="clear"></div>

                        </div>

                        <div class="clear"></div>
                    </div>
                        @endforeach
                    @endif
                    <!--信息 -->
                    <div class="order-go clearfix">
                        <div class="pay-confirm clearfix">
                            <div class="box">
                                @inject('goods', 'App\Presenters\ShoppingCartPresenter')
                                <div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
                                    <span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{ $goods->totalPrice($data['goods']) }}</em>
											</span>
                                </div>
                                @if(!empty($data['address']))
                                @foreach($data['address'] as $item)
                                    @if($item->status == 2)
                                        <div id="holyshit268" class="pay-address" data-address-id="{{ $item->id }}">

                                            <p class="buy-footer-address">
                                                <span class="buy-line-title buy-line-title-type">寄送至：</span>
                                                <span class="buy--address-detail">
                                           <span class="province">{{ $item->province  }}</span>
                                                        <span class="city">{{ $item->city  }}</span>
                                                        <span class="dist">{{ $item->county  }}</span>
                                                        <span class="street">{{ $item->detailed_address  }}</span>
                                                        </span>

                                            </p>
                                            <p class="buy-footer-address">
                                                <span class="buy-line-title">收货人：</span>
                                                <span class="buy-address-detail">
                                                 <span class="buy-user">{{ $item->consignee }} </span>
                                                        <span class="buy-phone">{{ $item->tel }}</span>
                                                 </span>
                                            </p>
                                        </div>
                                     @endif
                                 @endforeach
                                @endif
                            </div>

                            <div id="holyshit269" class="submitOrder">
                                <div class="go-btn-wrap">
                                    <a id="J_Go" href="javascript:;" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
        <!--底部-->
        @include('home.public.footer')
    </div>
@stop
@section('customJs')
    <script type="text/javascript" src="/js/address.js"></script>
    <script src="/layer/layer.js"></script>
    <script src="/js/check.js"></script>
    <script>
        // 更改收货地址
        $('.user-addresslist').click(function () {
            layer.load(2);
            // 修改省份
            $('#holyshit268').find('.province').html($(this).find('.province').html());
            // 修改城市
            $('#holyshit268').find('.city').html($(this).find('.city').html());
            // 修改县
            $('#holyshit268').find('.dist').html($(this).find('.dist').html());
            // 修改详细地址
            $('#holyshit268').find('.street').html($(this).find('.street').html());
            // 修改收货人
            $('#holyshit268').find('.buy-user').html($(this).find('.buy-user').html());
            // 修改收货人手机号
            $('#holyshit268').find('.buy-phone').html($(this).find('.buy-phone').html());
            // 收货地址表ID
            $('#holyshit268').attr('data-address-id',$(this).attr('data-address-id'));
            layer.closeAll()
        });
        // 提交订单
        $('#J_Go').click(function(){
            layer.load(3);
            // 初始化购买商品信息
            var goodsMessage =[];
            // 初始化收货地址信息
            var addressMessage;
            // 拼装商品信息
            $.each($('.item-content'),function(key,val){
                // 初始化货品信息
                var cargo={};
                // 获取货品数量
                cargo.shopping_number=$(val).find('.sl').html();
                // 商品标题
                cargo.cargo_title=$(val).find('.item-title').html();
                // 获取货品ID
                cargo.cargo_id = $(val).attr('data-cargo-id');
                // 添加到商品信息
                goodsMessage.push(cargo);
            });
            // 收货地址表ID
            addressMessage = $('#holyshit268').attr('data-address-id');
            // 定义支付方式
            var pay_type = $('.pay.selected').attr('data-pay-type');

            // 拼接提交参数
            var data = {
                'goods_message':JSON.stringify(goodsMessage),
                'address_id':addressMessage,
                'pay_type':pay_type,
                '_token':"{{ csrf_token() }}",
            };
            sendAjax(data,'/home/order',function (response) {
                layer.closeAll();
                if(response.ServerNo == 200){

                    window.location.href=response.ResultData;
                } else {
                    layer.msg(response.ResultData);
                }
            });

        });
    </script>
@stop