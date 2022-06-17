@if(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->count() <=0)
    <p class="text-center">You don't have any items in compare list</p>
@else
    <table class="table table-bordered mb-5">
    <tbody>
        <tr>
            <td class="com-title">Product Image</td>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                @php
                    $photo=explode(',',$item->model->photo);
                @endphp
            <td class="com-pro-img">
                <a href="{{route('product.detail',$item->model->slug)}}"><img src="{{asset($photo[0])}}" class="img-fluid" alt=""></a>
            </td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Product Name</td>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                <td><a href="{{route('product.detail',$item->model->slug)}}">{{$item->name}}</a></td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Price</td>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                <td>€ {{$item->price}}</td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Description</td>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                <td>{!! nl2br($item->model->summary) !!}
                </td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title">Category</td>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                <td>{{$item->model->category['title']}}</td>
            @endforeach
        </tr>
        <tr>
            <td class="com-title"></td>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content() as $item)
                <td class="action">
                    <a href="javascript:;" class="btn add_to_wishlist btn-success mb-1" data-id="{{$item->id}}" data-quantity="1" id="add_to_wishlist_{{$item->id}}"><span class="icon_heart_alt"></span></a>
                    <a href="javascript:;" data-id="{{$item->rowId}}" class="btn btn-danger mb-1 remove_from_compare delete-compare"><i class="fa fa-trash"></i></a>
                </td>
            @endforeach

        </tr>
    </tbody>
</table>
@endif

