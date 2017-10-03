<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forum</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('public/css/client.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header>

    </header>

    <div id="main_content">
        <div class="container">
            <div class="col-md-12" style="text-align:center;">
                <h1 style="font-size:80px;">404</h1>
                <p style="color:#ccc; font-size:18px;">For shame... This page no longer exists or may have never
                    existed...</p><br>
                <img class="not_found" src="{{url('public/uploads/img/r_404.png')}}" style="width: 300px;">
                <div style="clear:both"></div>
                <br><br>
                <div style="clear:both"></div>
                <br><br><br>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->

<script src="{{ asset('public/js/client.js') }}"></script>
<script src="{{ asset('public/js/app.js') }}"></script>
</body>

</html>
