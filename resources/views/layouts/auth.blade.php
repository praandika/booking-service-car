<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">

    <title>@yield('title')</title>

    <!-- vendor css -->
    <link href="{{ asset('admin/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/typicons.font/typicons.css') }}" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/azia.css') }}">

</head>

<body class="az-body">

    @yield('content')

    <script src="{{ asset('admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/js/azia.js') }}"></script>
    <script>
        $(function () {
            'use strict'

        });

    </script>
</body>

</html>
