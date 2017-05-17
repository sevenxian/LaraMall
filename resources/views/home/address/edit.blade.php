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
                                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">编辑收货地址</strong> /
                                    <small>Edit&nbsp;address</small>
                                </div>

                                @if(count(explode('?',request()->server()['HTTP_REFERER']))>1)
                                    {{ \Session::set('checkoutUrl', request()->server()['HTTP_REFERER']) }}
                                    <a href="{{ request()->server()['HTTP_REFERER'] }}" class="am-btn am-btn-danger" style="float:right">返回</a>
                                @endif
                            </div>

                            <hr/>

                            <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                                @if(!empty($data))
                                <form class="am-form am-form-horizontal" id="recommend">
                                    {{ csrf_field() }}
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-form-label">收货人</label>
                                        <div class="am-form-content">
                                            <input type="text" id="user-name" name="consignee" placeholder="收货人" value="{{ $data->consignee }}">
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="userErrorMessage">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-form-label">手机号码</label>
                                        <div class="am-form-content">
                                            <input id="user-phone" placeholder="手机号必填" name="tel" type="tel" value="{{ $data->tel }}">
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="telErrorMessage">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-address" class="am-form-label">所在地</label>
                                        <div class="am-form-content address">
                                            <select data-am-selected  name="province">
                                                <option value="{{ $data->province }}" selected="selected">{{ $data->province }}</option>
                                            </select>
                                            <select data-am-selected  name="city">
                                                <option value="{{ $data->city }}" selected="selected">{{ $data->city }}</option>
                                            </select>
                                            </select>
                                            <select data-am-selected  name="county">
                                                <option value="{{ $data->county }}" selected="selected">{{ $data->county }}</option>
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
                                            <textarea class="" name="detailed_address" rows="3" id="user-intro" placeholder="100字以内写出你的详细地址...">{{ $data->detailed_address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="introErrorMessage">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button class="am-btn am-btn-danger" type="button" data-id="{{ $data->id }}" id="submit">确认更新</button>
                                        </div>
                                    </div>
                                    <div class="am-form-group" style="color:red">
                                        <div class="am-form-content" id="introErrorMessage">
                                        </div>
                                    </div>
                                </form>
                                <div class="am-form-group" style="color:red;">
                                    <div class="am-form-content" style="width: 100%;text-align: center" id="ErrorMessage">
                                    </div>
                                </div>
                                @else
                                    <div class="am-form-group" style="color:red;">
                                        <div class="am-form-content" style="width: 100%;text-align: center" id="introErrorMessage">
                                            获取数据失败
                                        </div>
                                    </div>
                                @endif
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
    <script>
       // 提交验证
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
            var id = $(this).attr('data-id');
            var data={
                'consignee':$('#user-name').val(),
                'tel':$('#user-phone').val(),
                'detailed_address':$('#user-intro').val(),
                '_method':'put',
                '_token':"{{ csrf_token() }}"
            }
            sendAjax(data, "/home/address/"+id, function (response) {
                if (response.ServerNo == 200) {
                    window.location.href = '/home/address';
                } else {
                    $('#ErrorMessage').html(response.ResultData);
                }
            })
        })

    </script>
@stop