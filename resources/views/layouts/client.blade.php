<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Library | @yield('title')</title>
        <link rel="stylesheet" href="{{asset('Midone/Compiled/dist/css/app.css')}}" />
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
        <x-client.mobile-menu />
    <!-- END: Mobile Menu -->
        <!-- BEGIN: Top Bar -->
        <x-client.top-bar />

        <!-- END: Top Bar -->
        <!-- BEGIN: Top Menu -->
        <x-client.top-nav />
        <!-- END: Top Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- END: Content -->
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
