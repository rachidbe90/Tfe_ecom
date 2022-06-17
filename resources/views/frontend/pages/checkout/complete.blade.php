@extends('frontend.layouts.master')

@section('content')


<!-- Checkout complete Areao -->
<div class="checkout_area section_padding_100 m-auto my-5">
    <div class="container">
        <div class="row">
            <div class="col-6 m-auto">
                <div class="order_complated_area clearfix border p-4 text-center my-5">
                    <i class="fa fa-check-circle text-success" style="font-size: 26px; margin-bottom: 20px"></i>
                    <h5>Thank You For Your Order.</h5>
                    <p>You will receive an email of your order details</p>
                    <p class="orderid mb-0">Your Order id #{{$order}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Area End -->
@endsection

