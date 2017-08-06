@extends('layouts.default')

@section('body_class', 'nav-md')

@section('page')
<div class="container body">
    <div class="main_container">

        <!-- Sidebar left -->
        @include('partials.sidebar')
        <!-- /Sidebar left -->

        <!-- Top navigation -->
        @include('partials.navigation')
        <!-- /Top navigation -->

        <!-- Page content -->
        <div class="right_col" role="main">
            <div class="page-title">
                <div class="title_left">
                    <h3>@yield('title', 'Homepage')</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>@yield('title', 'Homepage')</h2>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page content -->

        <!-- Footer content -->
        <footer>
            <div class="pull-right">
                @include('partials.footer')
            </div>

            <div class="clearfix"></div>
        </footer>
        <!-- /Footer content -->
    </div>
</div>
@stop
