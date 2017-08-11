@extends('layouts.default')

@section('body_class', 'nav-md')

@section('page')
<div class="container body">
    <div class="main_container">

        <!-- Sidebar left -->
        @include('partials._sidebar')
        <!-- /Sidebar left -->

        <!-- Top navigation -->
        @include('partials._navigation')
        <!-- /Top navigation -->

        <!-- Page content -->
        <div class="right_col" role="main">
            <div class="page-title">
                <div class="title_left">
                    <h3>@yield('title', 'Homepage')</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            @yield('content')
        </div>
        <!-- /Page content -->

        <!-- Footer content -->
        <footer>
            <div class="pull-right">
                @include('partials._footer')
            </div>

            <div class="clearfix"></div>
        </footer>
        <!-- /Footer content -->
    </div>
</div>
@stop
