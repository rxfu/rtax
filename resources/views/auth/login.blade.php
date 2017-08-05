@extends('layouts.app')

@section('body_class', 'login')

@section('content')
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form class="form-horizontal" method="post" action="{{ route('login') }}">
                {{ csrf_field() }}

                <h1>登录系统</h1>
                <div>
                    <input id="username" name="username" type="text" class="form-control" placeholder="用户名" value="{{ old('username') }}" required autofocus>
                </div>
                <div>
                    <input id="password" name="password" type="password" class="form-control" placeholder="密码" required>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (!$errors->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div>
                    <button class="btn btn-default submit" type="submit">登录</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <div>
                        <p>&copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ config('setting.name') }}</a>. All rights reserved.<br>Powered By {{ config('setting.author') }}.</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
