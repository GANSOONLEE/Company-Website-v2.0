<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{config('app.name')}} | @yield('title') </title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- 要在 css 之前加載的文件 -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>

    @stack('before-style')

    <link rel="stylesheet" href="{{asset('css/backend/admin/layouts/page.css')}}">
    <link rel="stylesheet" href="{{asset('css/backend/admin/includes/sidebar.css')}}">

    <!-- 要在 css 之后加載的文件 -->
    @stack('after-style')

</head>
<body>

    <div class="app">

        @extends('backend.admin.includes.sidebar')

        <div class="page" id="page">

            <p class="page-title">@yield('title')</p>

            @yield('main')

        </div>

    </div>

    <!-- 要在 javascript 之前加載的文件 -->
    @stack('before-script')

    <script src="{{mix('/js/app.js')}}"></script>
    <script src="{{asset('js/backend/admin/includes/sidebar.js')}}"></script>

    <!-- 要在 javascript 之后加載的文件 -->
    @stack('after-script')
</body>
</html>