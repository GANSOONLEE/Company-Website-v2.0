<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Frozen Aircond, a company which is focusing on selling Car and Lorry air-conditioner.">
    <meta name="keywords" content="Frozen Aircond, Frozen Aircond Sdn Bhd ">
    <meta name="author" content="Frank Gan">
    <meta name="theme-color" content="light">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preload preconnect" as="script" href="https://www.googletagmanager.com/gtag/js?id=G-7M0FH94T9S">
    <link rel="preload preconnect" fetchpriority="high" as="image" href="{{ asset('images/background.webp') }}" type="image/webp">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7M0FH94T9S"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-7M0FH94T9S');
    </script>

    <!-- csrf -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="preload stylesheet" as="style" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script defer src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>
    
    <!-- 導入應用文件 -->
    <link rel="preload stylesheet" as="style" href="{{asset('css/app.css')}}">
    <link rel="preload" href="{{ asset('js/app.js') }}" as="script">

    <script src="{{mix('js/app.js')}}"></script>

    <!-- 導入全局文件 -->
    <link rel="preload stylesheet" as="style" href="{{asset('css/frontend/global.css')}}">
    <script defer src="{{asset('js/frontend/global.js')}}"></script>

    <!-- Pusher -->
    <script defer src="https://js.pusher.com/8.0.1/pusher.min.js"></script>

    @stack('before-body')

    <title>{{ config('app.name') }} | @yield('title')</title>
</head>
<body>

    @include('frontend.includes.navbar')

    <div id="alert">
        @if ($errors->any())
          <x-alert :state="'danger'">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </x-alert>
        @endif
        @if(session('success'))
          <x-alert :state="'success'">
              <li>{!! session('success') !!}</li>
          </x-alert>
        @endif
    </div>

    <div class="app">

        @yield('app')

    </div>

    @include('frontend.includes.footer')

</body>

    @stack('after-body')

</html>