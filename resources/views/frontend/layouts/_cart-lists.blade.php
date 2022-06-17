
<div class="col-12">
    <div class="cart-table">
        <div class="table-responsive" >
            <table class="table table-bordered mb-30">
                <thead>
                <tr>
                    <th scope="col"><i class="icofont-ui-delete"></i></th>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Product Size</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                    <tr>
                        <th scope="row">
                            <a href="javascript:;"><i class="fa fa-trash cart_delete text-danger"  data-id="{{$item->rowId}}"></i></a>
                        </th>
                        <td>
                            <img src="{{$item->model->photo}}" alt="Product" style="max-width: 100px;">
                        </td>

                        <td>
                            <a href="{{route('product.detail',$item->model->slug)}}" target="_blank">{{$item->name}}</a>
                        </td>
                        <td>
                            {{$item->options->has('size') ? $item->options->size : ''}}
                        </td>
                        <td>{{$item->price}} €</td>
                        <td>
                            <div class="quantity">
                                <input type="number" data-id="{{$item->rowId}}"  class="qty-text" id="qty-input-{{$item->rowId}}"  step="1" min="1" max="99" name="quantity" value="{{$item->qty}}">
                                <input type="hidden" data-id="{{$item->rowId}}" data-product-quantity="{{$item->model->stock}}" id="update-cart-{{$item->rowId}}">
                                <input type="hidden" data-id="{{$item->rowId}}" data-product-size="{{$item->options->has('size') ? $item->options->size : ''}}" id="update-cart-size-{{$item->rowId}}">
                                <input type="hidden" class="form-control" data-id="{{$item->rowId}}" data-product_id="{{$item->model->id}}" id="update-cart-product_id-{{$item->rowId}}">

                            </div>
                        </td>
                        <td>{{$item->subtotal()}} €</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-12 col-lg-6">
    <div class="cart-apply-coupon mb-30">
        <h6>Have a Coupon?</h6>
        <p>Enter your coupon code here &amp; get awesome discounts!</p>
        <!-- Form -->
        <div class="coupon-form">
            <form action="{{route('coupon.add')}}"  id="coupon-form" method="post">
                @csrf
                <input type="text" class="form-control" name="code" placeholder="Enter Your Coupon Code">
                <button type="submit" class="coupon-btn btn btn-info mt-2">Apply Coupon</button>
            </form>
        </div>
    </div>
</div>

<div class="col-12 col-lg-5 pb-4" id="cart_list">
    <div class="cart-total-area mb-30">
        <h5 class="mb-3">Cart Totals</h5>
        <div class="table-responsive">
            <table class="table mb-3">
                <tbody>
                <tr>
                    <td>Sub Total</td>
                    <td>{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}} €</td>
                </tr>
                <tr>
                    <td>Save Amount</td>
                    <td>@if(\Illuminate\Support\Facades\Session::has('coupon'))
                                {{number_format( \Illuminate\Support\Facades\Session::get('coupon')['value'] ,2)}}
                            @else 0
                            @endif €
                    </td>

                </tr>
                <tr>
                    <td>TVA</td>
                    <td>21%</td>
                </tr>
                <tr>
                    <td>Total</td>
                    @if (\Illuminate\Support\Facades\Session::has('coupon'))
                        <td>{{ number_format( (
                                filter_var( (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                                - filter_var( \Illuminate\Support\Facades\Session::get('coupon')['value'] , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                                ) + (
                                    (filter_var( (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                                - filter_var( (session('coupon')['value']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                                    )*0.21
                                    ) ,2
                                    ) }} €</td>
                    @else
                        <td>
                    {{ number_format( (
                                filter_var( (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                                ) + (
                                    (filter_var( (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal()), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
                                    )*0.21
                                    ) ,2
                                    ) }} €</td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
        <a href="{{route('checkout')}}" class="btn btn-info d-block">Proceed To Checkout</a>
    </div>
</div>
