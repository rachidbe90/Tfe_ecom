@extends('frontend.layouts.master')

@section('content')

    <!-- Main Content Section Start -->
    <div id="main" class="mb-5" style="padding-bottom: 80px;">
        <!-- Product Details Section Start -->
        <section class="product-details mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="product__details__images">
                            @php
                                $photos=explode(',',$product->photo);
                            @endphp
                            <div class="product__details__images__item">
                                <img class="product__details__images__item--large"
                                     src="{{asset($photos[0])}}" alt="Product Details">
                            </div>
                            <div class="product__details__images__slider owl-carousel owl-theme">

                                @foreach($photos as $key=>$photo)
                                    <img data-imgbigurl="{{asset($photo)}}"
                                         src="{{asset($photo)}}" alt="Product Thumbnail">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="row">
                            <div class="col-lg-8 mt-3">
                                <div class="product__details__content">
                                    <h4><strong>{{$product->title}}</strong></h4>
                                    <!-- Product Price Details -->
                                    <div class="product__details__price">
                                        <h4><strong id="offer_price">€ {{number_format($product->offer_price,2)}}</strong></h4>
                                        <del id="original_price">€ {{number_format($product->price,2)}}</del>
                                        @if($product->discount>0)
                                            <span class="price-offer">{{$product->discount}} % off</span>
                                        @endif
                                    </div>
                                    <!-- Product Descriptions -->
                                    <p class="product__descriptions mt-3">
                                        <strong>Description:</strong>
                                        {!! html_entity_decode($product->summary) !!}
                                    </p>

                                    <!-- Size Option -->
                                    @if(count($product->attributes)>0)
                                        <div class="widget p-0 size mb-3">
                                            <h6 class="widget-title">Size</h6>
                                            <div class="widget-desc" style="display: block;width: 45%;">
                                                @php
                                                    $product_attr=\App\Models\ProductAttribute::where('product_id',$product->id)->get();
                                                @endphp
                                                <select name="size" class="form-control" style="width: 50%" id="size">
                                                    <option value="">Select size</option>
                                                    @foreach($product_attr as $size)
                                                        <option value="{{$size->size}}">{{$size->size}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    <!-- Product QUantity -->
                                    <!-- Add to Cart Form -->
                                    <form action="">
                                        <div class="product__details__quantity">
                                                <div class="quantity">
                                                    <input data-id="{{$product->id}}" type="number" value="1" id="qty2" step="1" min="1" max="12" name="quantity" class="qty-text">
                                                </div>
                                        </div>

                                        <!--  Button & Widgets -->
                                        <button type="button"  name="addtocart" data-product_id="{{$product->id}}" data-quantity="1" data-price="{{$product->offer_price}}" id="add_to_cart_button_details_{{$product->id}}" class="add_to_cart_button_details primary-btn">ADD TO CART</button>
                                        @else
                                            <h4><strong class="text-danger">Out of stock</strong></h4>
                                        @endif
                                        <a href="javascript:;" class="heart-icon add_to_wishlist" data-id="{{$product->id}}" data-quantity="1" id="add_to_wishlist_{{$product->id}}"><span class="icon_heart_alt"></span></a>
                                        <a href="javascript:;" class="heart-icon add_to_compare" data-id="{{$product->id}}" data-quantity="1" id="add_to_compare_{{$product->id}}"><span class="fa fa-exchange"></span></a>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-3">
                                <div class="card product__aside p-3">
                                    <div class="warranty__opt p-lr">
                                        <label class="text-uppercase">Return &amp; Warranty</label>
                                        <div class="d-flex mt-2">
                                            <ul>
                                                <li>
                                                    <div class="right__infos">
                                                        <p> <i class="fa fa-check-square-o text-success"></i> 100% Authentic</p>
                                                    </div>
                                                    <div class="right__infos">
                                                        <p> <i class="fa fa-refresh text-success"></i> [ 7 Days ] Return &amp; Exchange Policy</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                           aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                           aria-selected="false">Specifications</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>Products Description</h6>
                                            {!! html_entity_decode($product->description) !!}
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>Additional Information</h6>
                                            {!! html_entity_decode($product->additional_info) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->
    </div>
    <!-- Main Content Section End -->

@endsection

@section('styles')
    <style>
        .nice-select {
            float: none;
        }

        .widget.size .widget-desc li {
            display: block;
        }

        .nice-select.open .list {
            width: 100%;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $('#size').change(function () {
            var size=$(this).val();
            $('.add_to_cart_button_details').attr('data-size',size);
        })
    </script>

@endsection
