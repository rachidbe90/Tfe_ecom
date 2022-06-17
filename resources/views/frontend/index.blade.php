@extends('frontend.layouts.master')

@section('content')

    @if(count($banners)>0)
    <!-- Hero Slider -->
        <div id="main-slider" class="main-slider-wrapper col-md-9 centered">
            <div class="owl-carousel owl-theme hero-slider">
                @foreach($banners as $banner)
                    <div class="item">
                        <img src="{{$banner->photo}}" alt="{{$banner->title}}">
                    </div>
                @endforeach
            </div>
        </div>
    <!-- Hero Section End -->
    @endif
        <!-- Main Content Section Start -->
        <div id="main">
            @if(count($categories)>0)
            <!-- Discount Offers on Categories -->
                <section class="discounted-categories mt-3 mb-3">
                    <div class="container-fluid">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="owl-carousel owl-theme discounted-carousel">
                                    @foreach($categories as $cat)
                                        <a href="{{route('product.category',$cat->slug)}}">
                                            <div class="item">
                                                <div class="img-wrapper">
                                                    <img src="{{asset($cat->photo)}}" alt="{{$cat->title}}" class="d-block w-100">
                                                    <div class="img-overlay"></div>
                                                    <div class="image-title" style="background: #61849C;  border-radius: 10px; box-shadow: 12px 12px 2px 1px rgba(97, 132, 156, .4);">
                                                        <h6 style="color: black">{{ucfirst($cat->title)}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <!-- Discount Offers on Categories End -->
            @endif
                <!-- Promotion Banner -->
            @if(count($new_products)>0)
            <!--New Arrivals Start -->
                <section class="new-arrivals-section mt-3 mb-3 ml-3 mr-3 pt-3 pb-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="mt-2 section-title">
                                    <h2 class="light-text">New <strong>Arrivals</strong></h2>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 d-flex justify-content-end align-items-center">
                                <div class="show-more-btn-wrapper">
                                    <a class="btn primary-btn btn-show-more" type="button" href="{{route('shop')}}">
                                        <i class="fa fa-eye"></i>
                                        <span>Show More</span>
                                    </a>
                                </div>
                            </div>
                            <!-- Products Carousel Start -->
                            <div class="col-xs-12 col-md-12">
                                <div class="product-slider-wrapper">
                                    <div class="owl-carousel owl-theme latest-product__slider">
                                        @foreach($new_products as $item)
                                                @include('frontend.layouts._single-product',['product'=>$item])
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!-- Product Carousel END -->
                        </div>
                    </div>
                </section>
            @endif
            <!--New Arrivals End-->
            <!-- Promo Start -->
            @if(count($promo_banner)>0)
                <section id="main-slider" class="main-slider-wrapper">
                    <div class="owl-carousel owl-theme hero-slider">
                        @foreach($promo_banner as $prom_banner)
                            <div class="item col-6 flex-row centered ">
                                <img src="{{$prom_banner->photo}}" alt="{{$prom_banner->title}}">
                            </div>
                        @endforeach

                    </div>
                </section>
            @endif
            <!-- Promo End -->
            <!-- Featured Section -->
            @if(count($featured_products)>0)
                <section class="featured-section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="mt-2 section-title">
                                    <h2 class="light-text">Featured <strong>Products</strong></h2>
                                </div>
                            </div>

                            <div class="col* col-sm-12 col-md-12 col-lg-12 arrival__list">
                                <div class="product-slider-wrapper">
                                    <div class="owl-carousel owl-theme featured-product__slider">
                                        @foreach($featured_products as $item)
                                            @include('frontend.layouts._single-product',['product'=>$item])
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <!-- Featured Section End-->
        </div>
    <!-- Main Content Section End -->

    <!-- Newsletter -->
    <div class="newsletter-wrapper pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                    <ul class="newsletter-follow mt-5">
                        <li>
                            <a href="{{get_setting('facebook_url')}}" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="{{get_setting('twitter_url')}}" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{get_setting('linkedin_url')}}" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="{{get_setting('pinterest_url')}}" target="_blank"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                    <ul class="d-flex mt-4">
                        <li class="mr-2">
                            <a href="https://play.google.com/">
                                <h6>Coming soon</h6>
                                <img src="{{asset('frontend')}}/img/footer/google-play.png" alt="" class="app-download-link">
                            </a>
                        </li>
                        <li>
                            <a href="https://appstoreconnect.apple.com/">
                                <h6>Coming soon</h6>
                                <img src="{{asset('frontend')}}/img/footer/app-store.png" alt="" class="app-download-link">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Form Ends -->

@endsection

@section('scripts')

@endsection
