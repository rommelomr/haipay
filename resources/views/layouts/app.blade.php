<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- css -->
    <link type="text/css" rel="stylesheet" href="{{asset('materialize/css/materialize.min.css')}}"  media="screen,projection"/>
    <!-- iconos -->
    <link type="text/css" rel="stylesheet" href="{{asset('material-design-icons/iconfont/material-icons.css')}}"  media="screen,projection"/>

    <link type="text/css" rel="stylesheet" href="{{asset('css/app.css')}}">

    @yield('head')
    <title>@yield('title')</title>
    <style>
        body{
            background: #eeeeee;
        }
    </style>
</head>
<body>
    @yield('main')

    <script type="text/javascript" src="{{asset('materialize/js/materialize.min.js')}}"></script>
    @yield('js')
</body>
</html>