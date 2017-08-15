<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Homepage') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Custom theme styles -->
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
    <style>
    /* Alternate stack initial positioning. This one is done through code,
      to show how it is done. Look down at the stack_bottomright variable
      in the JavaScript below. */
    .ui-pnotify.stack-bottomright {
      /* These are just CSS default values to reset the PNotify CSS. */
      right: auto;
      top: auto;
      left: auto;
      bottom: auto;
    }
    .ui-pnotify.stack-custom {
      /* Custom values have to be in pixels, because the code parses them. */
      top: 200px;
      left: 200px;
      right: auto;
    }
    .ui-pnotify.stack-custom2 {
      top: auto;
      left: auto;
      bottom: 200px;
      right: 200px;
    }
    /* This one is totally different. It stacks at the top and looks
      like a Microsoft-esque browser notice bar. */
    .ui-pnotify.stack-bar-top {
      right: 0;
      top: 0;
    }
    .ui-pnotify.stack-bar-bottom {
      margin-left: 15%;
      right: auto;
      bottom: 0;
      top: auto;
      left: auto;
    }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="{{ asset('html5shiv.min.js') }}"></script>
      <script src="{{ asset('respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="@yield('body_class')">
    @yield('page')

    @include('footer')

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/pnotify.js') }}"></script>
    <script src="{{ asset('js/pnotify.animate.js') }}"></script>
    <script src="{{ asset('js/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('js/pnotify.nonblock.js') }}"></script>
    @stack('scripts')

    <!-- Custom theme scripts -->
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script>
    $(function(){
        PNotify.removeAll();

        var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
        var stack_bottomleft = {"dir1": "right", "dir2": "up", "push": "top"};
        var stack_custom = {"dir1": "right", "dir2": "down"};
        var stack_custom2 = {"dir1": "left", "dir2": "up", "push": "top"};
        var stack_modal = {"dir1": "down", "dir2": "right", "push": "top", "modal": true, "overlay_close": true};
        var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
        var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};
        var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};

        @if (session('success'))
        new PNotify({
            title: '成功',
            text: '{{ session('success') }}',
            type: 'success',
            styling: 'bootstrap3',
            addClass: 'stack-bar-bottom',
            cornerclass: '',
            width: '70%',
            stack: stack_bar_bottom
        });
        @endif

        @if (session('error'))
        new PNotify({
            title: '出错啦',
            text: '{{ session('error') }}',
            type: 'error',
            styling: 'bootstrap3',
            addClass: 'stack-bar-bottom',
            cornerclass: '',
            width: '70%',
            stack: stack_bar_bottom
        });
        @endif

        @foreach ($errors->all() as $error)
        new PNotify({
            title: '验证错误',
            text: '{{ $error }}',
            type: 'error',
            styling: 'bootstrap3',
            addclass: 'stack-bar-bottom',
            cornerclass: '',
            width: '70%',
            stack: stack_bar_bottom
        });
        @endforeach
    });
    </script>
</body>
</html>
