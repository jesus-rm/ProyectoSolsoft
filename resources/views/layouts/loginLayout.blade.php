<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.min.js') }}" defer></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('libs/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('libs/jquery.counterup/jquery.counterup.js') }}"></script>
    <script src="{{ asset('libs/feather-icons/feather.js') }}"></script>
    <script src="{{ asset('libs/jquery-knob/jquery.knob.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('fonts/feather.ttf') }}">
    <link href="{{ asset('fonts/feather.woff') }}">
    <link href="{{ asset('fonts/materialdesignicons-webfont.ttf') }}">
    <link href="{{ asset('fonts/materialdesignicons-webfont.woff') }}">
    <link href="{{ asset('fonts/materialdesignicons-webfont.woff2') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
</head>
<body class="loading authentication-bg authentication-bg-pattern">
    <div id="app">
        <div class="account-pages my-5">
            @yield('content')
        </div>
    </div>
</body>
</html>
