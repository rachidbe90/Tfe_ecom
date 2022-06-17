<!-- Single Product -->
    <div class="product-wrapper">
    @php
        $photo=explode(',',$product->photo);
    @endphp
    <div class="card product-card">
        <div class="product-img-wrapper">
            <img class="card-img-top product-image" src="{{asset($photo[0])}}"
                 alt="Product Image">
        </div>
        <hr>
        <div class="card-body product-body">
            <h6 class="card-title product-title">
                <a href="{{route('product.detail',$product->slug)}}">
                    {{ucfirst($product->title)}}
                </a>
            </h6>
            <p class="card-text product-price">
                <del>€ {{number_format($product->price,2)}}</del>
                € {{number_format($product->offer_price,2)}}
            </p>
        </div>
    </div>
</div>
