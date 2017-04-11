@extends('admin.layouts.master')

@section('title')
    后台登陆
@stop

@section('header') @stop

@section('sidebar') @stop

@section('content')
    <div class="container">
        <form class="form-signin" action="index.html">
            <h2 class="form-signin-heading">管理员登录</h2>
            <div class="login-wrap">
                <!-- Errors Messages -->
                @include('notice.error')
                <input type="text" class="form-control" placeholder="手机号码" autofocus>
                <input type="password" class="form-control" placeholder="密码">
                <div class="form-line">
                    <input type="text" name="captcha" class="form-control pull-left" style="width: 160px"
                           placeholder="验证码">
                    <img id="captcha" src="{{ captcha_src() }}" class="pull-right" data-captcha-config="default">
                </div>
                <button class="btn btn-lg btn-login btn-block" type="submit">登陆</button>

            </div>

        </form>
    </div>
@stop

@section('customJs')
    <script>
        // 切换图片
        $('#captcha').on('click', function () {
            var captcha = $(this);
            var url = '/captcha/' + captcha.data('captcha-config') + '?' + Math.random();
            captcha.attr('src', url);
        });
    </script>
@stop