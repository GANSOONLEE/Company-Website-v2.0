<aside class="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('frontend.home') }}">
            <img src="{{ asset('image/logo-white.png') }}" alt="" class="sidebar-logo-image">
            <i class="sidebar-home-icon fa-solid fa-home"></i>
        </a>
    </div>

    <!-- Link -->
    <div class="link-section">

        <!-- Data 用戶數據 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('user_backend'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-user"></i>
                <p class="link-title-text">Account</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.user.data.user') }}"><li>Your Data</li></a>
            </ul>
        </section>
        @endif

        <!-- Cart 購物車 -->
        {{-- @if(auth()->user()->getRoleEntity()->hasPermission('admin_dashboard')) --}}
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-shopping-cart"></i>
                <p class="link-title-text">Cart</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.user.cart') }}"><li>Your cart</li></a>
            </ul>
        </section>
        {{-- @endif --}}

        <!-- Order 订单 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('create_order'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-list-alt"></i>
                <p class="link-title-text">Order</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul>
                <a href="{{ route('backend.user.order') }}"><li>Your Order</li></a>
            </ul>
        </section>
        @endif

    </div>

    <div class="account-area">
        <div class="avatar">
            <img src="{{asset('image/logo-square.png')}}" alt="" class="avatar-image">
            <a class="logout-href" href="{{ route('auth.logout') }}">
                <i class="logout-icon fa-solid fa-sign-out"></i>
            </a>
        </div>
        <div class="action">
            <p class="name">{{ auth()->user()->name }}</p>
            <p class="logout"><a href="{{ route('auth.logout') }}">Logout</a></p>
        </div>
    </div>

</aside>