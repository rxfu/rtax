@extends('layouts.default')

@section('body_class', 'login')

@section('title','登录')

@section('page')
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
                    @include('partials.footer')
                </div>
            </form>
        </section>
    </div>
</div>
@stop
