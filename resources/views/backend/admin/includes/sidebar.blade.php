<aside class="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('frontend.home') }}" aria-label="home">
            <img src="{{ asset('image/logo-white.webp') }}" alt="Logo" class="sidebar-logo-image">
            <i class="sidebar-home-icon fa-solid fa-home"></i>
        </a>
    </div>

    <!-- Link -->
    <div class="link-section">

        <!-- Dashboard 儀表板 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_dashboard'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-dashboard"></i>
                <p class="link-title-text">{{ __('sidebar.dashboard') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.admin.dashboard') }}"><li>{{ __('sidebar.data-analysis') }}</li></a>
                <a href="#"><li>{{ __('sidebar.traffic-analysis') }}</li></a>
                <a href="#"><li>{{ __('sidebar.user-analysis') }}</li></a>
            </ul>
        </section>
        @endif
       
        <!-- Product 產品 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_product'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-shopping-basket"></i>
                <p class="link-title-text">{{ __('sidebar.product') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.admin.product.create-product') }}"><li>{{ __('sidebar.create-product') }}</li></a>
                <a href="{{ route('backend.admin.product.edit-product') }}"><li>{{ __('sidebar.edit-product') }}</li></a>
            </ul>
        </section>
        @endif

        <!-- Model 車款 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_model'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-car"></i>
                <p class="link-title-text">{{ __('sidebar.model') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.admin.model.create') }}"><li>{{ __('sidebar.model-create') }}</li></a>
                <a href="{{ route('backend.admin.model.index') }}"><li>{{ __('sidebar.model-edit') }}</li></a>
            </ul>
        </section>
        @endif

        <!-- Category 品类 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_category'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-box"></i>
                <p class="link-title-text">{{ __('sidebar.category') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.admin.category.category-create') }}"><li>{{ __('sidebar.category-create') }}</li></a>
                <a href="{{ route('backend.admin.category.category-edit') }}"><li style="transform:rotateZ(50)">{{ __('sidebar.category-edit') }}</li></a>
            </ul>
        </section>
        @endif

        <!-- Brand 品牌 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_brand'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-tags"></i>
                <p class="link-title-text">{{ __('sidebar.brand') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.admin.brand.brand-create') }}"><li>{{ __('sidebar.brand-create') }}</li></a>
                <a href="{{ route('backend.admin.brand.brand-edit') }}"><li>{{ __('sidebar.brand-edit') }}</li></a>
            </ul>
        </section>
        @endif

        <!-- Media 媒体 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_image'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-box"></i>
                <p class="link-title-text">{{ __('sidebar.image') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.admin.image.carousel-image') }}"><li>{{ __('sidebar.carousel-image') }}</li></a>
                <a href="#"><li>{{ __('sidebar.product-image') }}</li></a>
            </ul>
        </section>
        @endif

        <!-- Order 订单 -->
        @if(auth()->user()->getRoleEntity()->hasPermission('admin_order'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-list-alt">
                    @if (\App\Domains\Order\Models\Order::getOrderNew() > 0)
                        <div class="notification"></div>
                    @endif
                </i>
                <p class="link-title-text">{{ __('sidebar.order') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul>
                <a href="{{ route('backend.admin.order.index') }}">
                    <li>
                        {{ __('sidebar.order-process') }}
                        @if (\App\Domains\Order\Models\Order::getOrderNew() > 0)
                            <div class="notification" id="notification-total-cart">{{ \App\Domains\Order\Models\Order::getOrderNew() }}</div>
                        @endif
                    </li>
                    
                </a>
                <a href="#"><li>{{ __('sidebar.order-holding') }}</li></a>
            </ul>
        </section>
        @endif

        @if(auth()->user()->getRoleEntity()->hasPermission('admin_user'))
        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-user"></i>
                <p class="link-title-text">{{ __('sidebar.user') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul class="">
                <a href="{{ route('backend.admin.account.user.management') }}"><li>{{ __('sidebar.user-management') }}</li></a>
                <a href="{{ route('backend.admin.account.role.management') }}"><li>{{ __('sidebar.role-management') }}</li></a>
                <a href="{{ route('backend.admin.account.permission.management') }}"><li>{{ __('sidebar.permission-management') }}</li></a>
                <a href="{{ route('backend.admin.account.account.banned') }}"><li>{{ __('sidebar.banned-account') }}</li></a>
                <a href="{{ route('backend.admin.account.user.operation') }}"><li>{{ __('sidebar.operation-record') }}</li></a>
            </ul>
        </section>
        @endif

        <section class="link-container">
            <div class="link-title">
                <i class="link-title-icon fa-solid fa-globe"></i>
                <p class="link-title-text">{{ __('sidebar.language') }}</p>
                <i class="fa-solid fa-angle-up"></i>
            </div>
            <ul>
                <a href="{{ route('locale.change', ['lang' => 'en']) }}"><li>English</li></a>
                <a href="{{ route('locale.change', ['lang' => 'zh']) }}"><li>中文</li></a>
                @if (auth()->user()->getRoleEntity()->hasPermission('zh-TW'))
                    <a href="{{ route('locale.change', ['lang' => 'zh-TW']) }}"><li>繁體中文</li></a>
                @endif
                @if (auth()->user()->getRoleEntity()->hasPermission('translation'))
                    <a target="_translation" href="{{ route('translation') }}"><li>Translation</li></a>
                @endif
            </ul>
        </section>

    </div>

    <div class="account-area">
        <div class="avatar">
                <img src="{{asset('image/logo-square.png')}}" alt="" class="avatar-image">
            <a class="logout-href" href="{{ route('auth.logout') }}" aria-label="logout">
                <i class="logout-icon fa-solid fa-sign-out"></i>
            </a>
        </div>
        <div class="action">
            <p class="name">{{ auth()->user()->name }}</p>
            <p class="logout"><a href="{{ route('auth.logout') }}">{{ trans('sidebar.logout') }}</a></p>
        </div>
    </div>

</aside>