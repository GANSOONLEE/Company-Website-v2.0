
<!-- Navbar -->
<nav class="navbar sticky max-[650px]:!h-[8vh] bg-white !z-99999" id="navbar">

    <!-- Company Logo -->
    <div class="flex justify-center items-center company-logo w-[4rem]">
        <img src="{{asset('image/logo-square-lite.webp')}}" alt="" class="company-logo-image !w-full h-auto" width="484" height="484">
    </div>

    <label class="cursor-pointer" for="menu-button">
        <i class="fa-solid fa-bars"></i>
    </label>

    <!-- control menu collapse -->
    <input type="checkbox" name="menu-button" id="menu-button">

    <!-- Collapse Menu -->
    <div class="menu bg-white flex justify-content-between align-items-center sm:flex-column max-[867px]:!py-[.75rem] max-[867px]:border max-[867px]:!border-gray-300 max-[867px]:shadow max-[740px]:!top-[8vh] min-[740px]:!top-[7vh]">
        
        <!-- Site Link -->
        <ul class="navbar-links">

            <li>
                <a href="{{ route('frontend.home') }}" class="navbar-link-frontend">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('frontend.product.index') }}" class="navbar-link-frontend">
                    Product
                </a>
            </li>

            <li>
                <a href="{{ route('frontend.gas-oil.index') }}" class="navbar-link-frontend">
                    Gas Oil
                </a>
            </li>
        </ul>

        <!-- Search Bar -->
        @include('components.searchbar')

        <!-- Auth -->
        <ul class="navbar-links">

            <!-- Guest -->
            @guest
                <li>
                    <a href="{{ route('auth.login.index') }}" class="navbar-link-frontend cta">
                        Login
                    </a>
                </li>

                <li>
                    <a href="{{ route('auth.register.index') }}" class="navbar-link-frontend">
                        Register
                    </a>
                </li>
            @endguest

            <!-- Check -->
            @auth

                <!-- Cart -->
                @if(auth()->user()->getRoleEntity()->hasPermission('user_backend'))
                    <a href="{{ route('backend.user.cart.create') }}" class="navbar-link-frontend cta">
                        <li>Cart</li>
                    </a>
                @endif

                <!-- Admin -->
                @if(auth()->user()->isAdmin() || auth()->user()->getRole()[0] === 'root')
                    <a href="{{ route('backend.admin.dashboard') }}" class="navbar-link-frontend">
                        <li>Dashborad</li>
                    </a>
                @endif

                <!-- Logout -->
                <a href="{{ route('auth.logout') }}" class="navbar-link-frontend">
                    <li>Logout</li>
                </a>
            @endauth
        </ul>
    </div>
</nav>