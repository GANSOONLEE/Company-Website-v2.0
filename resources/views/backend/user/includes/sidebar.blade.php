<aside class="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('frontend.home') }}">
            <img src="{{ asset('image/logo-white.png') }}" alt="" class="sidebar-logo-image">
        </a>
    </div>

    <!-- Link -->
    <div class="link-section">

        <!-- Dashboard 儀表板 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_dashboard'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-user"></i>
                <p class="link-title-text">Account</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="#"><li>Your Data</li></a>
            </ul>
        </section>
        @endif

        <!-- Dashboard 儀表板 -->
        {{-- @if(auth()->user()->getRoleEntity()->hasPermission('admin_dashboard')) --}}
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-shopping-cart"></i>
                <p class="link-title-text">Cart</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="#"><li>Your cart</li></a>
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
                <a href="#"><li>Order Placed</li></a>
                <a href="#"><li>Order Accepted </li></a>
                <a href="#"><li>Order in Progress</li></a>
                <a href="#"><li>Order On Hold</li></a>
                <a href="#"><li>Order Completed </li></a>
            </ul>
        </section>
        @endif

    </div>

    <div class="account-area">
        <div class="avatar">
            <img src="{{asset('image/logo-square.png')}}" alt="" class="avatar-image">
        </div>
        <div class="action">
            <p class="name">{{ auth()->user()->name }}</p>
            <p class="logout"><a href="{{ route('auth.logout') }}">Logout</a></p>
        </div>
    </div>

</aside>