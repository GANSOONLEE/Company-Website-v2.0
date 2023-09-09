
<nav class="navbar" id="navbar">

    <div class="company-logo">
        <img src="" alt="" class="company-logo-image">
    </div>
    <div class="menu">
        <ul class="navbar-links ">
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
            <!-- Guest -->
            @guest 
                <a href="" class="navbar-link">
                    <li class="navbar-link-label">Login</li>
                </a>
                <a href="" class="navbar-link">
                    <li class="navbar-link-label">Register</li>
                </a>
            @endguest
            @auth
                @if(auth()->user()->)   
            @endauth
        </ul>
    </div>
    <button type="button">
        <i></i>
    </button>
</nav>