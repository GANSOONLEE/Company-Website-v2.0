<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Frozen Aircond">
    <meta name="theme-color" content="dark">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light">
    <title> {{config('app.name')}} | @yield('title') </title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="perload stylesheet" as="style" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- 要在 css 之前加載的文件 -->
    <link rel="perload stylesheet" as="style" href="{{asset('css/app.css')}}">
    <script defer src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>
    <link rel="perload stylesheet" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"/>

    <!-- DataTables -->
    <link rel="preload stylesheet" as="style" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    @stack('before-style')

    <!-- Flowbite -->
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.min.css" />

    <link rel="preload stylesheet" as="style" href="{{ asset('css/backend/layouts/layout.css') }}">

    <!-- 要在 css 之后加載的文件 -->
    @stack('after-style')

</head>
<body>

    @routes

    <x-navbar />
    
    <div class="app" id="app">
    
        <x-sidebar />

        <div class="page" id="page">

          <div class="breadcrumbs">
            {{ Breadcrumbs::render() }}
          </div>

          <p class="page-title">@yield('title')</p>
          <p class="page-subtitle">@yield('subtitle', 'Subtitle')</p>

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
                  <li>{{ session('success') }}</li>
              </x-alert>
            @endif
          </div>

          <div class="content">

            @yield('main')
            
          </div>

        </div>

    </div>

    <!-- 要在 javascript 之前加載的文件 -->
    @stack('before-script')

    <script src="{{asset('js/app.js')}}"></script>

    <!-- DataTables -->
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- Flowbite -->
    <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
    
    <script>
        if (
          localStorage.getItem('color-theme') === 'dark' ||
          (!('color-theme' in localStorage) &&
            window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      </script>

    <!-- 要在 javascript 之后加載的文件 -->
    @stack('after-script')
</body>
</html>