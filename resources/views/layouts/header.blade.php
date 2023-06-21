<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('mazer/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo/logo_upt.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/logo/logo_upt.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('mazer/css/shared/iconly.css') }}">
    <style>
        .img-logo-sidebar {
            height: 70px !important;
            align-items: center;
            justify-content: center;
            width: auto;
            display: inline-block;
        }
    </style>


    @stack('css')
</head>

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
