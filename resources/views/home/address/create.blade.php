@extends('home.layouts.master')

@section('title')
    个人资料
@stop

@section('externalCss')
    <link href="/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/css/addstyle.css" rel="stylesheet" type="text/css">
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

                <div class="user-address">
                    <!--标题 -->
                    <hr/>
                    <!--例子-->
                    <div class="" id="doc-modal-1">

                        <div class="add-dress">

                            <!--标题 -->
                            <div class="am-cf am-padding">
                                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> /
                                    <small>Add&nbsp;address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;最多可创建9个</small>
                                </div>
                            </div>
                            <hr/>

                            <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                                <form class="am-form am-form-horizontal" method="post" action="{{ url('/home/address') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id">
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-form-label">收货人</label>
                                        <div class="am-form-content">
                                            <input type="text" id="user-name" name="consignee" placeholder="收货人">
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="userErrorMessage">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-form-label">手机号码</label>
                                        <div class="am-form-content">
                                            <input id="user-phone" placeholder="手机号必填" name="tel" type="tel">
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="telErrorMessage">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-address" class="am-form-label">所在地</label>
                                        <div class="am-form-content address">
                                            <select data-am-selected id="s_province" name="province">
                                            </select>
                                            <select data-am-selected id="s_city" name="city">
                                            </select>
                                            <select data-am-selected id="s_county" name="county">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="cityErrorMessage">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-form-label">详细地址</label>
                                        <div class="am-form-content">
                                            <textarea class="" name="detailed_address" rows="3" id="user-intro" placeholder="100字以内写出你的详细地址..."></textarea>
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="introErrorMessage">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button class="am-btn am-btn-danger" type="submit" id="submit">保存添加</button>
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="introErrorMessage">
                                            @if (count($errors) > 0)
                                                <div>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".new-option-r").click(function () {
                            $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                        });
                    })
                </script>

                <div class="clear"></div>

            </div>
            <!--底部-->
            @include('home.public.footer')
        </div>

        @include('home.public.aside')
    </div>
@stop
@section('customJs')
    <script src="{{ asset('/js/check.js') }}"></script>
    <script class="resources library" src="{{ asset('/js/area.js') }}" type="text/javascript"></script>
    <script type="text/javascript">_init_area();</script>
    <script>
        var Gid  = document.getElementById ;
        var showArea = function(){
            Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" +
                Gid('s_city').value + " - 县/区" +
                Gid('s_county').value + "</h3>"
        }

        $('#submit').click(function(){

            // 收件人判断
            if(!isNull($('#user-name').val())){
                $('#userErrorMessage').html('收货人不能为空');
                return false;
            }
            $('#userErrorMessage').html('');

            // 判断手机号码
            if(checkTel($('#user-phone'),$('#telErrorMessage')) != 100){
                return false;
            }

            // 所在收货城市判断
            if($('#s_province').val() =='省份'){
                $('#cityErrorMessage').html('请选择省份');
                return false;
            }
            if($('#s_city').val() =='地级市'){
                $('#cityErrorMessage').html('请选择城市');
                return false;
            }
            if($('#s_county').val() =='市、县级市'){
                $('#cityErrorMessage').html('请选择区县');
                return false;
            }
                $('#cityErrorMessage').html('');
            // 详细地址判断
            if(!isNull($('#user-intro').val())){
                 $('#introErrorMessage').html('详细地址不能为空')
                return false;
            }
            $('#introErrorMessage').html('');

            return true;
        })


//        Gid('s_county').setAttribute('onchange','showArea()');



    </script>
@stop