<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.front.style')

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- css jumbotron -->

    @stack('css')
</head>

<body class="overflow-x-hidden">
    <!-- navbar -->
    <div class="sticky z-20  top-0">
        @include('layouts.front.components.menu')
    </div>

    @yield('content')

    <!-- footer -->
    @include('layouts.front.footer')

    @include('layouts.front.script')

    @stack('js')
</body>

</html>
