@extends('frontend.layouts.master')

@section('content')

    <!-- Main Content Section Start -->
    <div id="main" class="mb-5">
        <!-- Product Grid View Section Start -->
        <section class="product-grid-container">
            <div class="container-fluid">
                <form action="{{route('shop.filter')}}" method="post" id="filter_products">
                    @csrf
                    <div class="row">

                    <!-- Product Filters -->
                    <div class="col-md-5 col-lg-2 mt-3">
                        <div class="product__filters-sidebar">
                            <!-- Categories Filter -->
                            <div class="product__filters">
                                <div class="product__filter-title pl-3 pr-3 pt-3 pb-3">
                                    <h5>Filters</h5>
                                </div>
                            @if(count($cats)>0)

                                <!-- Related Categories -->
                                <div class="product__filter-subtitle pl-3 pr-3 pt-2 pb-2">
                                    <span>Related Categories</span>
                                </div>
                                <div class="product__categories-list pl-3 pr-3 pt-2 pb-2">
                                    <ul>
                                        @if(!empty($_GET['category']))
                                            @php
                                                $filter_cats=explode(',',$_GET['category']);
                                            @endphp
                                        @endif
                                        @foreach($cats as $cat)
                                            <li><a href="{{route('product.category',$cat->slug)}}">{{ucfirst($cat->title)}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                            </div>

                            <!-- Price Range -->
                            <div class="product__filters pl-3 pr-3 pt-4 pb-4">
                                <div class="product__filter-subtitle">
                                    <span>Price Range <a href="{{ request()->url() }}" class="float-right btn btn-sm btn-info reset-price">Reset</a></span>
                                </div>
                                <div class="price-range-wrap mt-4">
                                    @if(!empty($_GET['price']))
                                        @php
                                            $price=explode('-',$_GET['price']);
                                        @endphp
                                    @endif
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                         data-min="@if(!empty($_GET['price'])){{$price[0]}}@else{{Helper::minPrice()}}@endif" data-max="@if(!empty($_GET['price'])){{$price[1]}}@else{{Helper::maxPrice()}}@endif">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                        <span tabindex="0"
                                              class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        <span tabindex="0"
                                              class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    </div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="hidden" id="price_range" name="price_range" @if(!empty($_GET['price'])) {{$_GET['price']}} @endif>
                                            <input type="text" id="minamount" value="">
                                            <input type="text" id="maxamount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Products Grid View -->
                    <div class="col-md-7 col-lg-9 pl-0 mt-3">

                        <!-- BreadCrumb Section Start -->
                        <section class="breadcrumb-section" style="margin-left: 10px; margin-bottom: 15px;">
                            <div class="row no-gutters">
                                <div class="col-lg-12">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item" ><a href="{{route('home')}}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </section>
                        <!-- BreadCrumb Section End -->
                        <div class="product-grid-view-wrap p-4">
                            <div class="filter-flex">
                                <div class="row">
                                    <div class="col-lg-7 d-flex align-items-center">
                                        <div class="product-title">
                                            <h5>Total Products : {{$products->total()}} </h5>
                                        </div>
                                    </div>
                                    <!-- Sort Section  -->
                                    <div class="col-lg-5 d-flex justify-content-end">
                                        <div class="product-sort">
                                            <div class="form-inline">
                                                <label for="">Sort By:</label>
                                                <select id="sortBy" class="small right" name="sortBy" onchange="this.form.submit()">
                                                    <option value=" ">Default Sort</option>
                                                    <option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceAsc') selected @endif>Price - Lower To Higher</option>
                                                    <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceDesc') selected @endif>Price - Higher To Lower</option>
                                                    <option value="titleAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleAsc') selected @endif>Alphabetical Ascending</option>
                                                    <option value="titleDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleDesc') selected @endif>Alphabetical Descending</option>
                                                    <<option value="discAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='discAsc') selected @endif>Discount - Lower To Higher</option>
                                                    <option value="discDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='discDesc') selected @endif>Discount - Higher To Lower</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Category filter Section -->
                            <div class="product-category-filter mt-2">
                                <div class="row">

                                    @foreach($products as $product)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                            @include('frontend.layouts._single-product',['product'=>$product])
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- pagination products -->
                        <div class="my-3">
                            {{$products->appends($_GET)->links('vendor.pagination.custom')}}
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </section>
        <!-- Product Grid View Section End -->
    </div>
    <!-- Main Content Section End -->

@endsection

@section('scripts')

{{--    Price slider--}}

<script>

    function filter(){
        $("#filter_products").submit();
    }

    $(document).ready(function(){
        /*-----------------------
            Price Range Slider
        ------------------------ */
        var rangeSlider = $(".price-range"),
            minamount = $("#minamount"),
            maxamount = $("#maxamount"),
            minPrice = rangeSlider.data('min'),
            maxPrice = rangeSlider.data('max');
        rangeSlider.slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                minamount.val('$ ' + ui.values[0]);
                maxamount.val('$ ' + ui.values[1]);
                var value=$("#price_range").val(ui.values[0]+"-"+ui.values[1]);
                filter();

            }
        });
        minamount.val('$ ' + rangeSlider.slider("values", 0));
        maxamount.val('$ ' + rangeSlider.slider("values", 1));

    });
</script>

@endsection
