@extends('frontend.layouts.master')

@section('content')

    <!-- Main Content Section Start -->
    <div id="main" class="mb-5 ">
        <div class="checkout-process-steps">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout Section Begin -->
        <section class="checkout">
            <div class="container">
                <div class="checkout__form">
                    <h4>Billing Details</h4>
                    <form action="{{route('checkout.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="sub_total" class="sub_total" value="{{(float)str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal())}}">
                        <input type="hidden" name="total_amount" class="total_amount" value="{{(float)str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal())}}">
                        <input type="hidden" name="coupon" class="coupon" value="">
                        <div class="row">
                            <!-- Checkout Form Starts -->
                            <div class="col-lg-7 col-md-6 billing-details">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" placeholder="First Name" value="{{$user->first_name}}" required name="first_name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" value="{{$user->last_name}}" name="last_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email Address"  name="email" value="{{$user->email}}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="phone" min="0" value="{{$user->phone}}" name="phone">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" value="{{$user->country}}" placeholder="eg. Nepal">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city"  placeholder="Town/City" value="{{$user->city}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode/Zip</label>
                                        <input type="text" class="form-control" id="postcode" placeholder="Postcode / Zip" value="{{$user->postcode}}" name="postcode">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">Street</label>
                                        <input type="text" class="form-control" id="street" placeholder="Street" value="{{$user->street}}" name="street">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">Number</label>
                                        <input type="number" class="form-control" id="num" placeholder="Number" value="{{$user->num}}" name="num">
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="payment_method">Payment Method</label><br>
                                        <input type="radio" name="payment_method" value="paypal" checked>Paypal

                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="payment_method">Delivery Options</label><br>
                                        <select name="delivery_charge" class="form-control w-100 delivery_charge" id="delivery_charge" required>
                                            <option value="">Select delivery options</option>
                                            @foreach(\App\Models\Shipping::where('status','active')->get() as $item)
                                                <option value="{{$item->delivery_charge }}" class="w-100 " data-price="{{$item->delivery_charge }}">€ {{$item->delivery_charge }} {{$item->shipping_address}} ({{$item->delivery_time}})</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label for="order-notes">Order Notes</label>
                                        <textarea class="form-control" id="order-notes" cols="30" rows="5" name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>

                                </div>
                            </div>
                            <!-- Checkout Form Ends -->

                            <!-- Checkout Order Summary -->
                            <div class="col-lg-5 col-md-6 order-summary">
                                <div class="checkout__order">
                                    <h5>Order Summary</h5>
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <ul>
                                        @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                            <li>
                                                <div class="cart__item--img">
                                                    <img src="{{$item->model->photo}}" alt="">
                                                    {{$item->name}}
                                                    <span>{{$item->price}} € x {{$item->qty}} </span>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="checkout__order__subtotal">Subtotal <span><span class="summary_subtotal_price">{{number_format(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal(),2)}} €</span> </span> </div>
                                    <div class="checkout__order__shipping">Coupon Fee <span><span class="summary_coupon_price">@if(\Illuminate\Support\Facades\Session::has('coupon')) {{number_format(\Illuminate\Support\Facades\Session::get('coupon')['value'],2)}} €@else 0 €@endif</span> </span> </div>
                                    <div class="checkout__order__shipping">TVA <span><span >21 %</span></span></div>
                                    <div class="checkout__order__shipping">Shipping Fee <span><span class="summary_delivery_charge">0 €</span> </span></div>

                                    <div class="checkout__order__total">Total
                                        <span class="summary_total"></span>
                                    </div>
                                    <div class="row">

                                        <div class="col-12 d-flex">
                                            <button type="submit" class="btn primary-btn">Proceed to Pay</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Checkout Order Summary Ends -->
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->
        <!-- Checkout Form End -->
    </div>
    <!-- Main Content Section End -->
    <!-- Checkout Area -->
@endsection

@section('scripts')
    <script>
        $('#delivery_charge').change(function(){
            var price=$(this).find(':selected').data('price')
            $(".summary_delivery_charge").text(price + ' €');
            var subtotal=$('.summary_subtotal_price').text();
            var coupon=$('.summary_coupon_price').text();
            var total=(parseFloat(subtotal.replace(/,/g,''))-parseFloat(coupon));
            var totalWithVat=+parseFloat(price)+total+(total*21)/100;
            $(".summary_total").text((totalWithVat).toFixed(2) + ' €');
            $('.sub_total').val(parseFloat(subtotal.replace(/,/g,'')));
            $('.total_amount').val(parseFloat(totalWithVat));
            $('.coupon').val(parseFloat(coupon));

        });
        var subtotal=$('.summary_subtotal_price').text();
        var coupon=$('.summary_coupon_price').text();
        var total=(parseFloat(subtotal.replace(/,/g,''))-parseFloat(coupon));
        var totalWithVat=total+(total*21)/100;
        $(".summary_total").text((totalWithVat).toFixed(2)+ ' €');
        $('.sub_total').val(parseFloat(subtotal.replace(/,/g,'')));
        $('.total_amount').val(parseFloat(totalWithVat));
        $('.coupon').val(parseFloat(coupon));
    </script>
@endsection
