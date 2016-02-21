<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>{{ $site_name  }}——@yield('title')</title>
    @yield('stylesheets')
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}" />
</head>
<body>

@yield('navbar')
@yield('body')

{{--<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('js/base.js') }}" type="text/javascript"></script>

@yield('javascripts')

</body>
</html>
