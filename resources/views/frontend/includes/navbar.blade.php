
<nav class="navbar sticky" id="navbar">

    <div class="company-logo">
        <img src="{{asset('image/logo-square-lite.png')}}" alt="" class="company-logo-image">
    </div>
    <input type="checkbox" name="menu-button" id="menu-button">
    <label for="menu-button">
        <i class="fa-solid fa-bars"></i>
    </label>

    <div class="menu flex justify-content-between align-items-center sm:flex-column">
        <ul class="navbar-links common">
            <a href="{{ route('frontend.home') }}" class="navbar-link">
                <li class="navbar-link-label">Home</li>
            </a>
            <a href="{{ route('frontend.product.index') }}" class="navbar-link">
                <li class="navbar-link-label">Product</li>
            </a>
            <a href="{{ route('frontend.contact') }}" class="navbar-link">
                <li class="navbar-link-label">Contact</li>
            </a>
        </ul>

        @include('components.searchbar')

        <ul class="navbar-links auth">
            <!-- Guest -->
            @guest
                <a href="{{ route('auth.login') }}" class="navbar-link primary">
                    <li class="navbar-link-label">Login</li>
                </a>
                <a href="{{ route('auth.register') }}" class="navbar-link">
                    <li class="navbar-link-label">Register</li>
                </a>
            @endguest

            <!-- Auth -->
            @auth
                @if(auth()->user()->getRoleEntity()->hasPermission('user_backend'))
                    <a href="{{ route('backend.user.cart.create') }}" class="navbar-link secondary">
                        <li class="navbar-link-label">Cart</li>
                    </a>
                @endif
                @if(auth()->user()->isAdmin() || auth()->user()->getRole()[0] === 'root')
                    <!-- admin -->
                    <a href="{{ route('backend.admin.dashboard') }}" class="navbar-link primary">
                        <li class="navbar-link-label">Dashborad</li>
                    </a>
                {{-- @elseif(auth()->user()->isUser())
                    <!-- user -->
                    @if(auth()->user()->getRoleEntity()->hasPermission('user_backend'))
                    <a href="{{ route('backend.user.cart') }}" class="navbar-link primary">
                        <li class="navbar-link-label">Dashborad</li>
                    </a>
                    @endif --}}
                @endif

                <a href="{{ route('auth.logout') }}" class="navbar-link">
                    <li class="navbar-link-label">Logout</li>
                </a>
            @endauth
        </ul>
    </div>
</nav>