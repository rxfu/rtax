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
    <link href="{{ asset('fonts/font-awesome/css/pnofity.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Custom theme styles -->
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">

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
    <script src="{{ asset('js/pnofity.js') }}"></script>
    @stack('scripts')

    <!-- Custom theme scripts -->
    <script src="{{ asset('js/custom.min.js') }}"></script>
    @if (session('status'))
    <script>
        @if (session('status.success'))
        new PNotify({
            title: '成功',
            text: {{ session('status.success') }},
            type: 'success',
            styling: 'bootstrap3'
        });
        @endif
    </script>
    @endif
</body>
</html>
