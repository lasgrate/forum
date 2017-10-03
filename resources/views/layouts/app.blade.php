<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! $forum->title !!}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset("public/css/forum/decor_$forum->decor_id.css") }}" rel="stylesheet">
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/letterpic/js/jquery.letterpic.js') }}"></script>
</head>
<body>
<div id="app">
    @yield('content')
</div>

</body>

</html>
