<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.remaja.auth-remaja.style')
    @stack('css')

    <title>@yield('title')</title>

</head>

<body class="">
    @yield('content')
</body>
@include('layouts.remaja.auth-remaja.js')
@stack('js')

</html>
