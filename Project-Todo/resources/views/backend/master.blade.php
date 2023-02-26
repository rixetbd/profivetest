@php
$currentRouteName = Route::currentRouteName();
@endphp

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
    <link rel="stylesheet" href="{{asset('assets/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    @yield('custom_css')

</head>

<body>

    @if ($currentRouteName != 'frontend.welcome' && $currentRouteName != 'login' && $currentRouteName != 'register')
    @include('backend.nav')
    @endif

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js"></script>
    <script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{asset('assets/js/notyf.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <script>
        // CSRF Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Create an instance of Notyf
        var notyf = new Notyf();
    </script>

    @yield('custom_js')

</body>

</html>
