<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="light">
    <meta name="description" content="Frozen Aircond">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- csrf -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link rel="preload stylesheet" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script async src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>

    <!-- Vue -->
    <script async src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    
    <!-- 導入應用文件 -->
    <link defer rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/frontend/includes/navbar.css')}}"> --}}
    <script defer src="{{asset('js/app.js')}}"></script>

    <!-- 導入全局文件 -->
    <link rel="preload stylesheet" as="style" href="{{asset('css/auth/global.css')}}">
    <script defer src="{{asset('js/auth/global.js')}}"></script>

    <!-- Pusher -->
    <script defer src="https://js.pusher.com/8.0.1/pusher.min.js"></script>

    @stack('before-body')

    <title>{{env('APP_NAME')}} | @yield('title')</title>
</head>
<body>

    <div id="alert"></div>

    <div class="app">

        @yield('app')



    </div>

</body>

    @stack('after-body')

</html>