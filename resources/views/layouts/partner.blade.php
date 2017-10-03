<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Scripts -->
  <script type="text/javascript" src="{{ asset('public/js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/js/datetimepicker/moment.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/js/datetimepicker/moment-with-locales.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/js/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>

  <!-- Styles -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link type="text/css" href="{{ asset('public/css/admin.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('public/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

</head>
<body>
@yield('content')
</body>
</html>
