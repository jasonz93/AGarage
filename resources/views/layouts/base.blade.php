<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta property="wb:webmaster" content="d28bcd86d443ecb9" />
    <title>{{ $site_name  }}——@yield('title')</title>
    @yield('stylesheets')
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}" />
    @yield('css')
</head>
<body>

@yield('navbar')
@yield('body')

<script src="{{ asset('js/base.js') }}" type="text/javascript"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>

@yield('javascripts')

</body>
</html>
