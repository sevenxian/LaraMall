@extends('admin.layouts.master')

@section('title')
    FlatLab - Flat & Responsive Bootstrap Admin Template
@stop

@section('header') @stop

@section('sidebar') @stop

@section('content')
    <div class="container">
        <form class="form-signin" action="index.html">
            <h2 class="form-signin-heading">sign in now</h2>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="User ID" autofocus>
                <input type="password" class="form-control" placeholder="Password">
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                    <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
                </label>
                <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
                <p>or you can sign in via social network</p>
                <div class="login-social-link">
                    <a href="index.html" class="facebook">
                        <i class="icon-facebook"></i>
                        Facebook
                    </a>
                    <a href="index.html" class="twitter">
                        <i class="icon-twitter"></i>
                        Twitter
                    </a>
                </div>

            </div>

        </form>
    </div>
@stop