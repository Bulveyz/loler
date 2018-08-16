<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

    <!-- Vendors Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/html-stream/html-stream.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <!-- Header -->
    <header>
        @include('layouts.header')
    </header>
    <!-- End Header -->

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer></footer>
    <!-- End Footer -->
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
