
<nav class="navbar" id="navbar">

    <div class="company-logo">
        <img src="{{asset('image/logo-square.png')}}" alt="" class="company-logo-image">
    </div>
    <input type="checkbox" name="menu-button" id="menu-button">
    <label for="menu-button">
        <i class="fa-solid fa-bars"></i>
    </label>
    <div class="menu">
        <ul class="navbar-links common">
            <a href="" class="navbar-link">
                <li class="navbar-link-label">Home</li>
            </a>
            <a href="" class="navbar-link">
                <li class="navbar-link-label">About Us</li>
            </a>
            <a href="" class="navbar-link">
                <li class="navbar-link-label">Product</li>
            </a>
            <a href="" class="navbar-link">
                <li class="navbar-link-label">Contact</li>
            </a>
        </ul>
        <ul class="navbar-links auth">
            <!-- Guest -->
            @guest
                <a href="" class="navbar-link primary">
                    <li class="navbar-link-label">Login</li>
                </a>
                <a href="" class="navbar-link">
                    <li class="navbar-link-label">Register</li>
                </a>
            @endguest

            <!-- Auth -->
            @auth
                @if(auth()->user())

                @endif
            @endauth
        </ul>
    </div>
</nav>