<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.remaja.front.style')
    @stack('css')

    <title>@yield('title')</title>
    <div class="loading-overlay">
        <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_p8bfn5to.json" background="transparent"
            speed="1" style="width: 183px; height: 183px;" loop autoplay></lottie-player>
    </div>
</head>

<body class="">
    @yield('content')


</body>
@include('layouts.remaja.front.js')
@stack('js')

</html>
