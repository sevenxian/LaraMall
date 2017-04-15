@extends('home.layouts.master')

@section('title')
    注册
@stop

@section('coreCss')
    <link rel="stylesheet" href="/AmazeUI-2.4.2/assets/css/amazeui.css"/>
@stop

@section('externalCss')
    <link href="/css/dlstyle.css" rel="stylesheet" type="text/css">
@stop

@section('header')
    @include('home.public.loginBoxtitle')
@stop

@section('content')
    <div class="res-banner">
        <div class="res-main">
            <div class="login-banner-bg"><span></span><img src="/images/big.jpg"/></div>
            <div class="login-box">
                <div class="am-tabs" id="doc-my-tabs">
                    <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                        <li class="am-active"><a href="">邮箱注册</a></li>
                        <li><a href="">手机号注册</a></li>
                    </ul>

                    <div class="am-tabs-bd">
                        <div class="am-tab-panel am-active">
                            <form method="post" class="registerForm">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div class="user-email">
                                    <label for="email"><i class="am-icon-envelope-o"></i></label>
                                    <input type="email" name="" id="email" placeholder="请输入邮箱账号">
                                </div>
                                <div class="user-pass">
                                    <label for="password"><i class="am-icon-lock"></i></label>
                                    <input type="password" name="" id="password" placeholder="设置密码">
                                </div>
                                <div class="user-pass">
                                    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                    <input type="password" name="" id="passwordRepeat" placeholder="确认密码">
                                </div>

                            </form>

                            <div class="login-links">
                                <label for="reader-me">
                                    <input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
                                </label>
                            </div>
                            <div class="am-cf">
                                <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>

                        </div>

                        <div class="am-tab-panel">
                            <form method="post" class="registerForm" id="telForm">
                                {{ csrf_field() }}
                                <div class="user-phone">
                                    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                                    <input type="tel" name="tel" id="phone" placeholder="请输入手机号">
                                </div>
                                <div class="verification">
                                    <label for="code"><i class="am-icon-code-fork"></i></label>
                                    <input type="tel" name="" id="code" placeholder="请输入验证码">
                                    <a class="btn" href="javascript:void(0);" onclick="sendMobileCode();"
                                       id="sendMobileCode">
                                        <span id="dyMobileButton">获取</span></a>
                                </div>
                                <div class="user-pass">
                                    <label for="password"><i class="am-icon-lock"></i></label>
                                    <input type="password" name="" class="password" placeholder="设置密码">
                                </div>
                                <div class="user-pass">
                                    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                    <input type="password" name="" id="rel_password" placeholder="确认密码">
                                </div>
                            </form>
                            <div class="login-links">
                                <label for="reader-me">
                                    <input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
                                </label>
                            </div>

                            <div class="am-cf">
                                <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl"
                                       onclick="submitParam(1)">
                            </div>

                            <hr>
                        </div>

                        <script>
                            $(function () {
                                $('#doc-my-tabs').tabs();
                            })
                        </script>

                    </div>
                </div>

            </div>
        </div>

        @include('home.public.footer')
    </div>
@stop
@section('customJs')

    <script>
        function sendMobileCode() {
            sendAjax({
                'tel': $('#phone').val(),
                '_token': $('#token').val()
            }, "{{ url('/home/register/sendMobileCode') }}", function (response) {

                if (response.ServerNo == 200) {

                    alert(response.ResultData);
                } else {
                    alert('发送失败');

                }
            })
        }

        function submitParam(type) {
            var data;
            if (type == 1) {
                data = {
                    'tel': $('#phone').val(),
                    'code': $('#code').val(),
                    'registerType': 1,
                    'password': $('.password').val(),
                    'rel_password': $('#rel_password').val(),
                    '_token': $('#token').val(),
                }
            } else {

            }
            sendAjax(data, "{{ url('home/register/createUser') }}", function (response) {

            })

        }

        function sendAjax(data, sendUrl, back) {
            $.ajax({
                type: "post",
                url: sendUrl,
                data: data,
                datatype: "json",
                success: function (response) {
                    back(response)
                }
            })
        }
    </script>

@stop
