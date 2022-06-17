<header class="header" id="header">
    <!-- Header Top Area Begin -->
    <div class="header__top">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Header Top Left Area -->
                <div class="col-lg-5 col-md-5">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="ri-mail-send-fill"></i> {{get_setting('email')}}</li>
                            <li><i class="ri-phone-fill"></i> {{get_setting('phone')}}</li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area -->
                <div class="col-lg-7 col-md-7">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="{{get_setting('facebook_url')}}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="{{get_setting('twitter_url')}}" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="{{get_setting('linkedin_url')}}" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="{{get_setting('pinterest_url')}}" target="_blank"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Top Area Ends -->

    <!-- Header Bottom Area Start -->
    <div class="container-fluid">
        <div class="row">
            <!-- Logo -->
            <div class="col-md-12 d-dm-none col-lg-2 d-flex pl-0 pr-0 align-items-center justify-content-start header__logo__wrapper">
                <div class="header__logo mr-4 ml-4">
                    <div class="navbar-brand">
                        <a href="{{route('home')}}"><img src="{{asset(get_setting('logo'))}}" alt="Logo" class="logo"><h4><span class="badge badge-secondary" style="background: #61849C">AYAMARKET</span></h4></a>
                    </div>
                </div>
            </div>
            <!-- Search panel -->
            <div class="col-lg-7 d-dm-none d-flex pl-0 pr-0 align-items-center justify-content-center">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{route('search')}}">
                            <input type="text" placeholder="Search Products here.." name="query" required>
                            <button type="submit" class="site-btn"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Widget -->
            <div class="col-lg-3 d-none d-md-flex d-lg-flex pl-0 pr-0 align-items-center justify-content-center">
                <div class="header__cart">
                    <ul class="header__cart__menu">
                        <li class="header__top__right__wishlist">
                            <a href="{{route('wishlist')}}" class="cart-links">
                                <i class="bi-heart-fill"></i>
                                <span id="wishlist_counter">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count()}}</span>
                            </a>
                        </li>
                        <li class="header__top__right__cart">
                            <a href="{{route('cart')}}" class="cart-links">
                                <i class="bi-cart-fill"></i>
                                <span id="cart_counter">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count()}}</span>
                            </a>
                        </li>
                        <!-- Login Modal Button -->
                        <li class="header__top__right__auth">
                            <a href="@auth {{route('user.dashboard')}} @else  {{route('user.auth')}} @endauth" class="cart-links"><i class="bi-person-fill"></i></a>
                            <a href="@auth {{route('user.dashboard')}} @else  {{route('user.auth')}} @endauth"><span>Hello, @auth {{auth()->user()->first_name}} @else Sign In @endauth</span>  </a>
                        </li>
                        <!-- Login Modal Button Ends -->
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="humberger__open">
        <i class="fa fa-bars"></i>
    </div>
    <!-- Header Bottom Area End -->
</header>
<!-- Header Section End -->

<!-- Navbar Section -->
<section class="navbar-section">
    <div class="container-fluid">
        <div class="row">
            <!-- Search Panel -->
            <div class="nav col-lg-8 d-flex justify-content-center">
                <nav class="header__menu">
                    <ul class="nav nav-tabs">
                        <li class="nav-item {{request()->is('/') ? 'nav-link active' : ''}}"><a href="{{route('home')}}"><i class="bi-house-door"></i>Home</a></li>
                        <li class="nav-item {{request()->is('shop') ? 'nav-link active' : ''}}"><a href="{{route('shop')}}"><i class="bi-shop"></i>Shop</a></li>
                        <li class="nav-item {{request()->is('compare') ? 'nav-link active' : ''}}"><a href="{{route('compare')}}"><i class="bi-list-stars"></i>Compare</a></li>
                        <li class="nav-item {{request()->is('contact-us') ? 'nav-link active' : ''}}"><a href="{{route('contact.us')}}"><i class="bi-mailbox"></i>Contact</a></li>
                        <li class="nav-item {{request()->is('about-us') ? 'nav-link active' : ''}}"><a href="{{route('about.us')}}"><i class="bi-people-fill"></i>About Us</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</section>
<!-- Navbar Section Ends -->
