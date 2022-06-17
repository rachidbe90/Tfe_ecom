<!doctype html>
<html lang="en">

<head>
   @include('frontend.layouts.head')
</head>

<body>
<!-- Mobile View Layout -->
<!-- Humberger Menu Start- Mobile View -->
<div class="humberger__menu__wrapper " style="z-index: 10000; /* A adapter au besoin */">
    <div class="humberger__menu__widget" >

        <!-- Right Widget -->

        <!-- cart-wish Modal Button -->
        <div class="humberger__menu__widget">
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
                    </li>
                    <!-- Login Modal Button Ends -->
                </ul>
            </div>
        </div>
        <!-- cart-wish Modal Button End-->
    </div>

    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="{{request()->is('/') ? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
            <li class="{{request()->is('shop') ? 'active' : ''}}"><a href="{{route('shop')}}">Shop</a></li>
            <li class="{{request()->is('compare') ? 'active' : ''}}"><a href="{{route('compare')}}">Compare</a></li>
            <li class="{{request()->is('contact-us') ? 'active' : ''}}"><a href="{{route('contact.us')}}">Contact</a></li>
            <li class="{{request()->is('about-us') ? 'active' : ''}}"><a href="{{route('about.us')}}">About Us</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
</div>
<!-- Humberger Menu End -->

<!-- Header Section Begin -->
<div id="header-ajax">
    @include('frontend.layouts.header')
</div>

@yield('content')

<!-- Footer Section Starts -->
@include('frontend.layouts.footer')

@include('cookieConsent::index')

@include('frontend.layouts.script')

</body>

</html>
