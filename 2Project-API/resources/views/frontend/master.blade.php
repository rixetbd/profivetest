<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title')</title>

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/notyf.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    @yield('custom_css')

</head>

<body>

    @yield('content')

    <script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/notyf.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

    @yield('custom_js')

</body>

</html>
