<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Frozen Aircond">
    <meta name="theme-color" content="light">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- csrf -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script defer src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>

    <!-- Vue -->
    <script defer src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    
    <!-- 導入應用文件 -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="{{mix('js/app.js')}}"></script>

    <!-- 導入全局文件 -->
    <link rel="stylesheet" href="{{asset('css/frontend/global.css')}}">
    <script src="{{asset('js/frontend/global.js')}}"></script>

    <!-- Pusher -->
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>

    @stack('before-body')

    <title>{{env('APP_NAME')}} | @yield('title')</title>
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