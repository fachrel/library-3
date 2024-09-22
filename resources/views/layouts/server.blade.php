<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Library | @yield('title')</title>
        <link rel="stylesheet" href="{{asset('Midone/Compiled/dist/css/app.css')}}" />
        {{-- <link rel="stylesheet" href="{{asset('Rubick/Compiled/dist/css/app.css')}}" /> --}}
        <style>
            .flash-message {
                position: fixed;
                top: 20px;
                right: 20px;
                width: 350px;
                z-index: 9999;
            }
        </style>
    </head>
    <body class="app">
        <x-alert/>
        <!-- BEGIN: Mobile Menu -->
        <x-server.mobile-menu />
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <x-server.side-menu />
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <x-server.top-bar />
                <!-- END: Top Bar -->
                @yield('content')
            </div>
            <!-- END: Content -->
        </div>
        <script src="{{asset('Midone/Compiled/dist/js/app.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.flash-message').fadeOut('slow');
                }, 3000);
            });
        </script>

    </body>
</html>
