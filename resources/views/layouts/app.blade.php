<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Server Minecraft Stats')">
    <meta name="theme-color" content="#1A1A2E">
    <meta name="author" content="GroupeZ">

    <meta property="og:title" content="@yield('title', 'Minecraft Stats')">
    <meta property="og:type" content="@yield('type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="">
    <meta property="og:description" content="@yield('description', 'Server Minecraft Stats'))">
    <meta property="og:site_name" content="Minecraft Stats">
    @stack('meta')

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Minecraft Stats</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Styles // Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('scripts')

    @stack('styles')
</head>
<body>

<div id="app">

    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')

</div>

@stack('footer-scripts')
</body>
</html>
