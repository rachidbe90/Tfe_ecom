@extends('frontend.layouts.master')

@section('content')


    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- About Us Area -->
    <section class="about_us_area section_padding_100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4">
                    <div class="about_us_content pb-5 pb-lg-0">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset($about->image)}}" alt="about us">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="about_us_content pl-0 pl-lg-5">
                        <h5>{{$about->heading}}</h5>
                        <p>{!! nl2br($about->content) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Area -->

    <!-- Service Start -->
    <div class="container">
        <section class="features-area mb-10">
            <div class="container">
                <div class="row">
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-service-area mb-50">
                            <i class="fa fa-paypal"></i>
                            <h5>Secure Payment Gateway</h5>
                            <p>Payflow Gateway is PayPal's secure and open payment gateway.</p>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-service-area mb-50">
                            <i class="fa fa-certificate"></i>
                            <h5>Quality Products</h5>
                            <p>Each garment requires more attention at the stage of production and after production</p>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-service-area mb-50">
                            <i class="fa fa-truck"></i>
                            <h5>Fast Delivery</h5>
                            <p>You can follow your parcel online with Track & Trace or the My bpost app by Bpost</p>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-service-area mb-50">
                            <i class="fa fa-facebook"></i>
                            <h5>Live FaceBook</h5>
                            <p>Follow our facebook live to discover our news</p>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-service-area mb-50">
                            <i class="fa fa-support"></i>
                            <h5>Customer Support</h5>
                            <p>service available 7/7, at your service</p>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-service-area mb-50">
                            <i class="fa fa-instagram"></i>
                            <h5>Catalog instagram</h5>
                            <p>Check our catalogue regularly also on our instagram page </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Service END -->
    <section class="about_us_one cool_facts_area section_padding_100_70 bg-overlay jarallax" style="background: #dddddd;padding: 30px ">
        <div class="container">
            <div class="row">
                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="cool_fact_text text-center wow fadeInUp" data-wow-delay="0.2s">
                        <h2><span class="counter">{{$about->experience}}</span>+</h2>
                        <h5>Years of experience</h5>
                    </div>
                </div>
                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="cool_fact_text text-center wow fadeInUp" data-wow-delay="0.4s">
                        <h2><span class="counter">{{$about->happy_customer}}</span>+</h2>
                        <h5>Happy Customer</h5>
                    </div>
                </div>
                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="cool_fact_text text-center wow fadeInUp" data-wow-delay="0.6s">
                        <h2><span class="counter">{{$about->team_advisor}}</span>+</h2>
                        <h5>Team Advisor</h5>
                    </div>
                </div>
                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="cool_fact_text text-center wow fadeInUp" data-wow-delay="0.8s">
                        <h2><span class="counter">{{$about->return_customer}}</span>%</h2>
                        <h5>Return Customer</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cool Facts Area End -->

@endsection

@section('styles')
    <style>
        /* About CSS */
        .about_us_content {
            position: relative;
            z-index: 1;
        }
        .about_us_content h5 {
            font-size: 1.6rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        @media only screen and (max-width: 767px) {
            .about_us_content h5 {
                font-size: 1.2rem;
            }
        }
        .about_us_content p {
            font-size: 18px;
        }
        @media only screen and (max-width: 767px) {
            .about_us_content p {
                font-size: 16px;
            }
        }
        .about_us_content img {
            margin-bottom: 30px;
            border-radius: 10px;
        }
        .about_us_content .col-6:nth-child(2) img {
            margin-top: 50px;
        }
        .about_us_content .col-6:nth-child(3) img {
            margin-top: -50px;
        }

        .single-service-area {
            position: relative;
            z-index: 1;
            text-align: center;
            border:1px solid #ddd;
            padding: 16px 10px;
            margin-bottom: 30px;
        }
        .single-service-area i {
            -webkit-transition-duration: 500ms;
            -o-transition-duration: 500ms;
            transition-duration: 500ms;
            display: block;
            margin-bottom: 1rem;
            font-size: 3rem;
            color: #070a57; }
        .single-service-area p {
            margin-bottom: 0; }
        .single-service-area:hover i, .single-service-area:focus i {
            color: #0f99f3; }

    </style>
@endsection

