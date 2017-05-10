@extends('home.layouts.master')

@section('title')
    购物车
@stop

@section('coreCss')
    <link href="/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css"/>
@stop

@section('externalCss')
    <link href="/basic/css/demo.css" rel="stylesheet" type="text/css"/>
    <link href="/css/cartstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/css/optstyle.css" rel="stylesheet" type="text/css"/>
@stop

@section('coreJs')
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script src="/layer/layer.js"></script>
@stop

@section('header')
    @include('home.public.amContainer')
@stop

@section('nav')
    @include('home.public.nav')
@stop

@section('content')
    <!--购物车 -->
    <div class="concent">
        <div id="cartTable">
            <div class="cart-table-th">
                <div class="wp">
                    <div class="th th-chk">
                        <div id="J_SelectAll1" class="select-all J_SelectAll">

                        </div>
                    </div>
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
                    <div class="th th-op">
                        <div class="td-inner">操作</div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <tr class="item-list">
                <div class="bundle  bundle-last ">
                    <div class="bundle-hd">
                        <div class="bd-promos" style="padding: 10px 0px">
                        </div>
                    </div>
                    <div class="clear"></div>
                    @if(!empty($data))
                        <div class="bundle-main">
                            @foreach($data as $value)
                                <ul class="item-content clearfix">
                                    <li class="td td-chk">
                                        <div class="cart-checkbox">
                                            <input class="check" id="J_CheckBox_170769542747" name="items"
                                                   type="checkbox" checked="checked" value="{{ $value['id'] }}"/>
                                            <label for="J_CheckBox_170769542747"></label>
                                        </div>
                                    </li>
                                    <li class="td td-item">
                                        <div class="item-pic">
                                            <a href="/home/goodsDetail/{{ $value['id'] }}" target="_blank"
                                               data-title="{{ $value['cargo_name'] }}" class="J_MakePoint"
                                               data-point="tbcart.8.12">
                                                <img src="{{ env('QINIU_DOMAIN') }}{{ $value['cargo_cover'] }}?imageView2/1/w/80/h/80"
                                                     class="itempic J_ItemImg">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-basic-info">
                                                <a href="/home/goodsDetail/{{ $value['id'] }}" target="_blank"
                                                   title="{{ $value['cargo_name'] }}" class="item-title J_MakePoint"
                                                   data-point="tbcart.8.11">{{ str_limit($value['cargo_name'], 70, '...') }}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-info">
                                        <div class="item-props item-props-can"
                                             style="text-align: left; padding-left: 20px;">
                                            @if(!empty($value['label']))
                                                @foreach($value['label'] as $k => $v)
                                                    <span class="sku-line">{{ str_replace('选择', '', $v['label_name']) }}
                                                        ：{{ $v['attr_name'] }}</span><br>
                                                @endforeach
                                            @endif
                                            <i class="theme-login am-icon-sort-desc"></i>
                                        </div>
                                    </li>
                                    <li class="td td-price">
                                        <div class="item-price price-promo-promo">
                                            <div class="price-content">
                                                <div class="price-line">
                                                    <em class="J_Price price-now"
                                                        tabindex="0">{{ $value['price'] }}</em>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-amount">
                                        <div class="amount-wrapper ">
                                            <div class="item-amount ">
                                                <div class="sl">
                                                    <input class="min am-btn" name="" type="button" value="-"/>
                                                    <input class="text_box" name="" type="text"
                                                           value="{{ $value['shopping_number'] }}" id="inventory"
                                                           data-default-number="{{ $value['shopping_number'] }}"
                                                           style="width:30px;"/>
                                                    <input class="add am-btn" name="" type="button" value="+"/>
                                                    <div style="color:#ccc;" class="message">
                                                        @if($value['inventory'] == 0)
                                                            无货
                                                        @else
                                                            有货
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-sum">
                                        <div class="td-inner">
                                            <em tabindex="0" class="J_ItemSum number"
                                                data-default-price="{{ $value['shopping_number']*$value['price'] }}">{{ $value['shopping_number']*$value['price'] }}
                                                .00</em>
                                        </div>
                                    </li>
                                    <li class="td td-op">
                                        <div class="td-inner">
                                            <a href="javascript:;" data-point-url="#"
                                               data-cargo-id="{{ $value['cargo_id'] }}"
                                               class="delete">
                                                删除</a>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align: center; padding: 50px 0;">
                            <a href="{{ url('/') }}" style="color: red;">购物车空空的哦~，去看看心仪的商品吧~</a>
                        </div>
                    @endif
                </div>
            </tr>
        </div>
        <div class="clear"></div>
        @if(!empty($data))
            <div class="float-bar-wrapper">
                <div id="J_SelectAll2" class="select-all J_SelectAll">
                    <div class="cart-checkbox">
                        <input class="check-all check" id="J_SelectAllCbx2" checked="checked" name="select-all"
                               value="true" type="checkbox">
                        <label for="J_SelectAllCbx2"></label>
                    </div>
                    <span>全选</span>
                </div>
                <div class="operations">
                    <a href="javascript:;" hidefocus="true" class="deleteAll" id="del">删除</a>
                </div>
                <div class="float-bar-right">
                    <div class="amount-sum">
                        <span class="txt">已选商品</span>
                        <em id="J_SelectedItemsCount"></em><span class="txt">件</span>
                        <div class="arrow-box">
                            <span class="selected-items-arrow"></span>
                            <span class="arrow"></span>
                        </div>
                    </div>
                    <div class="price-sum">
                        <span class="txt">合计:</span>
                        <strong class="price">¥<em id="J_Total"></em></strong>
                    </div>
                    <div class="btn-area">
                        <a href="javascript:;" id="J_Go" class="submit-btn submit-btn-disabled"
                           aria-label="请注意如果没有选择宝贝，将无法结算" style="link:#fff} ">
                            <span>结&nbsp;算</span></a>
                    </div>
                </div>

            </div>
        @endif
        @include('home.public.footer')
    </div>

    <!--操作页面-->
    <div class="theme-popover-mask"></div>

    <div class="theme-popover">
        <div class="theme-span"></div>
        <div class="theme-poptit h-title">
            <a href="javascript:;" title="关闭" class="close">×</a>
        </div>
        <div class="theme-popbod dform">
            <form class="theme-signin" name="loginform" action="" method="post">

                <div class="theme-signin-left">

                    <li class="theme-options">
                        <div class="cart-title">颜色：</div>
                        <ul>
                            <li class="sku-line selected">12#川南玛瑙<i></i></li>
                            <li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
                        </ul>
                    </li>
                    <li class="theme-options">
                        <div class="cart-title">包装：</div>
                        <ul>
                            <li class="sku-line selected">包装：裸装<i></i></li>
                            <li class="sku-line">两支手袋装（送彩带）<i></i></li>
                        </ul>
                    </li>
                    <div class="theme-options">
                        <div class="cart-title number">数量</div>
                        <dd>
                            <input class="min am-btn am-btn-default" name="" type="button" value="-"/>
                            <input class="text_box" name="" type="text" value="1" style="width:30px;"/>
                            <input class="add am-btn am-btn-default" name="" type="button" value="+"/>
                            <span class="tb-hidden">库存<span class="stock">1000</span>件</span>
                        </dd>

                    </div>
                    <div class="clear"></div>
                    <div class="btn-op">
                        <div class="btn am-btn am-btn-warning">确认</div>
                        <div class="btn close am-btn am-btn-warning">取消</div>
                    </div>

                </div>
                <div class="theme-signin-right">
                    <div class="img-info">
                        <img src="/images/kouhong.jpg_80x80.jpg"/>
                    </div>
                    <div class="text-info">
                        <span class="J_Price price-now">¥39.00</span>
                        <span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @include('home.public.navCir')
@stop
@section('customJs')
    <script src="/js/check.js"></script>
    <script>
        // 获取总数量元素
        var totalNumberObj = $('#J_SelectedItemsCount');
        // 获取总价格元素
        var totalPriceObj = $('#J_Total');
        // 初始化总价格
        var totalPrice = 0;
        // 初始化总数量
        var totalNumber = 0;
        // 进入页面显示总价格总数量
        getData($("input[name='items']"), totalPrice, totalNumber);

        // 购物车全部选中或者全部清除
        $('#J_SelectAllCbx2').click(function () {
            // 重新设定初始值
            totalPrice = 0;
            totalNumber = 0;
            // 获取购物车checkbox
            var obj = $("input[name='items']");
            // 判断选中或者不选中
            if ($(this).attr('checked')) {
                // 便利购物车数据
                getData(obj, totalPrice, totalNumber);
            } else {
                // 把货品从购物车删除
                $.each(obj, function (key, value) {
                    $(value).attr('checked', false);
                });
                // 把数据填充到页面
                $('#J_SelectedItemsCount').html(totalNumber);
                $('#J_Total').html(totalPrice);
            }
        });

        // 选定指定货品计算总价及数量
        $("input[name='items']").click(function () {
            layer.load(2);
            // 获取当前选中货品数量
            var number = $(this).parents('.item-content').find('.text_box').val();
            // 获取当前选中货品的总价格
            var price = $(this).parents('.item-content').find('.J_ItemSum').html();
            // 判断复选框是否选中
            if ($(this).attr('checked')) {
                // 计算货品总数
                totalNumberObj.html(parseInt(totalNumberObj.html()) + parseInt(number));
                // 计算货品价格
                totalPriceObj.html(parseInt(totalPriceObj.html()) + parseInt(price));
            } else {
                // 计算货品总数
                totalNumberObj.html(totalNumberObj.html() - number);
                // 计算货品价格
                totalPriceObj.html(totalPriceObj.html() - parseInt(price));
            }
            layer.closeAll();
        });

        // 删除单条商品
        $('.delete').click(function () {
            layer.load(2);
            var obj = $(this);
            // 获取货品ID
            var data = new Array(obj.attr('data-cargo-id'));
            sendAjax({'cargoId': data}, '/home/delShoppingCart', function (response) {
                if (response.ServerNo == 200) {
                    if (response.ResultData == 0) {
                        $('.bundle-main').html('<div style="text-align: center; padding: 50px 0;"><a href="{{ url('/') }}" style="color: red;">购物车空空的哦~，去看看心仪的商品吧~</a> </div>');
                        $('.float-bar-wrapper').remove();
                    } else {
                        // 获取当前选中货品数量
                        var number = obj.parents('.item-content').find('.text_box').val();
                        // 获取当前选中货品的总价格
                        var price = obj.parents('.item-content').find('.J_ItemSum').html();
                        totalNumberObj.html(totalNumberObj.html() - number);
                        totalPriceObj.html(totalPriceObj.html() - price);
                        obj.parents('.item-content').hide();
                    }
                }
            });
            layer.closeAll();
        });

        // 删除选中的商品
        $('#del').click(function () {
            layer.load(2);
            var obj = $("input[name='items']");
            var param = new Array;
            $.each(obj, function (key, value) {
                if (value.checked) {
                    param[key] = $(value).val();
                }
            });
            sendAjax({'cargoId': param}, '/home/delShoppingCart', function (response) {
                if (response.ServerNo == 200) {
                    $('.bundle-main').html('<div style="text-align: center; padding: 50px 0;"><a href="{{ url('/') }}" style="color: red;">购物车空空的哦~，去看看心仪的商品吧~</a> </div>');
                    $('.float-bar-wrapper').remove();
                }
            });
            layer.closeAll();
        });

        // 数量加加
        $('.add').click(function () {
            layer.load(2);
            var obj = $(this);
            // 获取商品单价
            var price = parseInt(obj.parents('.item-content').find('.J_Price').html());

            // 获取点击后的数量进行库存查询
            var number = parseInt(obj.parents('.item-content').find('.text_box').val()) + 1;

            // 总数量
            var totalNumber = parseInt($('#J_SelectedItemsCount').html());
            var totalPrice = parseInt($('#J_Total').html());

            // 初始化查询参数
            var data = {
                cargoId: obj.parents('.item-content').find('.check').val(),
                number: number
            };

            // 新增
            sendAjax(data, '/home/checkShoppingCart', function (response) {
                console.log();
                if (response.ServerNo == 200) {
                    var data = response.ResultData;
                    // 改变信息提示
                    obj.parents('.item-content').find('.message').html('有货');
                    // 单价
                    obj.parents('.item-content').find('.J_Price').html(data.price);
                    // 金额
                    obj.parents('.item-content').find('.J_ItemSum').html(data.price * number + '.00');
                    // 总数量
                    $('#J_SelectedItemsCount').html(totalNumber + 1);
                    // 总金额
                    getData($("input[name='items']"), 0, 0);
                    // 超过促销数量不再享受优惠
                    if (number > data.promotion_number) {
                        layer.alert('购买超过' + data.promotion_number + '件时,不再享受优惠！');
                    }
                } else if(response.ServerNo == 410){
                    layer.alert(response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(200);
                } else if(response.ServerNo == 412){
                    layer.alert('商品数量不能超过'+response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(response.ResultData);
                } else if(response.ServerNo == 414){
                    layer.alert(response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(0);
                } else {
                    layer.alert(response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(number - 1);
                }
                layer.closeAll('loading');
            });
        });

        // 数量减减
        $('.min').click(function () {
            var obj = $(this);
            // 获取商品单价
            var price = parseInt(obj.parents('.item-content').find('.J_Price').html());
            // 获取数量
            var number = parseInt(obj.parents('.item-content').find('.text_box').val());
            if(number == 0){
                return;
            }

            layer.load(2);

            // 初始化查询参数
            var data = {
                cargoId: obj.parents('.item-content').find('.check').val(),
                number: number - 1
            };

            if (number > 1) {
                // 总数量
                var totalNumber = parseInt($('#J_SelectedItemsCount').html());
                // 总价格
                var totalPrice = parseInt($('#J_Total').html())
                // 删减
                sendAjax(data, '/home/checkShoppingCart', function (response) {
                    if (response.ServerNo == 200) {
                        var data = response.ResultData;
                        // 单价
                        obj.parents('.item-content').find('.J_Price').html(data.price);
                        // 计算价格
                        obj.parents('.item-content').find('.J_ItemSum').html(data.price * (number - 1) + '.00');
                        // 计算总数量
                        $('#J_SelectedItemsCount').html(totalNumber - 1);
                        // 总金额
                        getData($("input[name='items']"), 0, 0);
                        // 超过促销数量不再享受优惠
                        if ((number - 1) > data.promotion_number) {
                            layer.alert('购买超过' + data.promotion_number + '件时,不再享受优惠！');
                        }
                    } else {
                        layer.alert(response.ResultData);
                        // 显示原本数量
                        obj.parents('.item-content').find('.text_box').val(number + 1);
                    }
                    layer.closeAll('loading');
                });
            } else {
                obj.parents('.sl').find('.text_box').val(2);
                layer.closeAll('loading');
            }
        });

        // 随意填写数量
        $('.text_box').on('blur', function () {
            layer.load(2);
            var obj = $(this);

            // 获取点击后的数量进行库存查询
            var number = parseInt(obj.parents('.item-content').find('.text_box').val());

            // 初始化查询参数
            var data = {
                'cargoId': obj.parents('.item-content').find('.check').val(),
                'number': number,
            };

            // 查询货品数量是否充足
            sendAjax(data, '/home/checkShoppingCart', function (response) {
                console.log(response);
                if (response.ServerNo == 200) {
                    var data = response.ResultData;
                    // 改变信息提示
                    obj.parents('.item-content').find('.message').html('有货');
                    // 单价
                    obj.parents('.item-content').find('.J_Price').html(data.price);
                    // 计算价格
                    obj.parents('.item-content').find('.J_ItemSum').html(data.price * number + '.00');
                    // 总金额
                    getData($("input[name='items']"), 0, 0);
                    // 超过促销数量不再享受优惠
                    if (number > data.promotion_number) {
                        layer.alert('购买超过' + data.promotion_number + '件时,不再享受优惠！');
                    }
                } else if(response.ServerNo == 410){
                    layer.alert(response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(200);
                } else if(response.ServerNo == 412){
                    layer.alert('商品数量不能超过'+response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(response.ResultData);
                } else if(response.ServerNo == 414){
                    layer.alert(response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(0);
                } else {
                    layer.alert(response.ResultData);
                    // 显示原本数量
                    obj.parents('.item-content').find('.text_box').val(number);
                }
                layer.closeAll('loading');
            });
        });

        // 页面初始化以及全部选中函数
        function getData(obj, totalPrice, totalNumber) {
            // 便利购物车数据
            $.each(obj, function (key, value) {
                // 把货品全部添加到购物车
                $(value).attr('checked', 'checked');
                // 计算总价格
                totalPrice = parseInt(totalPrice) + parseInt(($(value).parents('.item-content').find('.J_ItemSum').html()));
                // 计算货品总数
                totalNumber = parseInt(totalNumber) + parseInt(($(value).parents('.item-content').find('.text_box').val()));
            });
            // 把数据填充到页面
            totalNumberObj.html(totalNumber);
            totalPriceObj.html(totalPrice);
        }

        // 更新购物车数据
        $('#J_Go').click(function () {
            var cargo_id = '';
            var shopping_number = '';
            $.each($("input[name='items']"), function (key, value) {
                // 把货品全部添加到购物车
                if ($(value).attr('checked')) {
                    shopping_number += $(value).parents('.item-content').find('.text_box').val() + ',';
                    cargo_id += $(value).parents('.item-content').find('.check').val() + ',';
                }
            });

            if (!cargo_id || !shopping_number) {
                return layer.msg('没有选择宝贝，无法结算');
            }

            // 拆分数组
            location.href = '/home/order/create?cargo_id=' + cargo_id.substring(0, cargo_id.length - 1) + '&shopping_number=' + shopping_number.substring(0, shopping_number.length - 1);
        });
    </script>
@stop