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
    
    <!-- Flowbite -->
    <link rel="preload stylesheet" as="style" href="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.min.css" />

    <!-- 要在 css 之前加載的文件 -->
    <link rel="preload stylesheet" as="style" href="{{asset('css/app.css')}}">
    <script defer src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>
    <link rel="preload stylesheet" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"/>

    @stack('before-style')
    
    <script defer src="{{ asset('js/app.js') }}"></script>
    <link rel="preload stylesheet" as="style" href="{{ asset('css/backend/layouts/layout.css') }}">

    <!-- 要在 css 之后加載的文件 -->
    @stack('after-style')

</head>
<body>

    @routes

    <x-navbar />
    <span id="logo-sidebar" hidden></span>
    
    <div class="app" id="app">

      @if(request()->is('admin*'))
        <x-sidebar />  
      @elseif(request()->is('user*'))
        <x-sidebar-user />
      @endif

        <div class="page !ml-0 lg:!ml-[16rem]" id="page">

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
                  <li>{!! session('success') !!}</li>
              </x-alert>
            @endif
          </div>

          <div id="toast-notification" class="fixed hidden bottom-8 right-8 w-full max-w-xs p-4 text-gray-900 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-300" role="alert">
            <div class="flex items-center mb-3">
                <span class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">New notification</span>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-notification" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <div class="flex items-center">
                <div class="text-sm font-normal">
                    <div class="text-sm font-bold text-gray-900 text-underline dark:text-white">Frozen Aircond Sdn. Bhd.</div>
                    <div class="text-sm font-normal" id="notification-text"></div> 
                    <span class="text-xs font-medium text-blue-600 dark:text-blue-500">a few seconds ago</span>   
                </div>
            </div>
          </div>

          <div class="content">

            @yield('main')
            
          </div>

        </div>

    </div>

    <!-- 要在 javascript 之前加載的文件 -->
    @stack('before-script')

    <!-- Pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>

      let pusher = new Pusher('a018306a14faf67a1d14', {
        cluster: 'ap1',
      });

      let channel = pusher.subscribe('backend');

      channel.bind('notification.created', function(data) {
        showNotification(data);
      });
      
      // 顯示公告
      function showNotification(data) {
        let notification = document.getElementById('toast-notification');
        document.getElementById('notification-text').innerText = data.messages;
        
        notification.classList.remove('hidden');
        
        setTimeout(function() {
          hideNotification();
        }, data?.duration ?? 5);
      }
      
      // 隱藏公告
      function hideNotification() {
        let notification = document.getElementById('toast-notification');
        notification.classList.add('hidden');
      }

      channel.bind('order.created', function(data) {
        showNewOrder(data);
      });

      function showNewOrder(data) {
        let notification = document.querySelector('#new-order-notification');
        notification.hidden = false;
        notification.innerText = data.count;
      }
      </script>

    <!-- 要在 javascript 之后加載的文件 -->
    @stack('after-script')
</body>
</html>