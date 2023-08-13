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
    <div class="loading-overlay">
        <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_p8bfn5to.json"  background="transparent"  speed="1"  style="width: 183px; height: 183px;"  loop  autoplay></lottie-player>
      </div>
</body>
@include('layouts.remaja.auth-remaja.js')
@stack('js')

</html>
