<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{config('app.name')}} | @yield('title') </title>

    <!-- 要在 css 之前加載的文件 -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>

    @stack('before-style')

    <link rel="stylesheet" href="{{asset('css/backend/user/layouts/page.css')}}">
    <link rel="stylesheet" href="{{asset('css/backend/user/includes/sidebar.css')}}">

    <!-- 要在 css 之后加載的文件 -->
    @stack('after-style')

</head>
<body>

    <div class="app">

        @extends('backend.admin.includes.sidebar')

        <div class="page">

            <p class="page-title">@yield('title')</p>

            @yield('main')

        </div>

    </div>

    <!-- 要在 javascript 之前加載的文件 -->
    @stack('before-script')

    <script src="{{mix('/js/app.js')}}"></script>
    <script src="{{asset('js/backend/user/includes/sidebar.js')}}"></script>

    <!-- 要在 javascript 之后加載的文件 -->
    @stack('after-script')
</body>
</html>