@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive" id="wishlist_list">
                            @include('frontend.layouts._wishlist')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->

@endsection

@section('scripts')

    <script>
        $(document).on('click','.wishlist_delete',function(e){
            e.preventDefault();
            var wishlist_id=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('wishlist.delete')}}";

            $.ajax({
                url:path,
                type:"POST",
                dataType:"JSON",
                data:{
                    wishlist_id:wishlist_id,
                    _token:token,
                },
                success:function (data) {
                    console.log(data);

                    if(data['status']){
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_counter').html(data['wishlist_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });

                    }
                },
                error:function (err) {
                    console.log(err);
                }
            });
        });
    </script>

{{--    <script>--}}
{{--        $('.delete_wishlist').on('click',function (e) {--}}

{{--            e.preventDefault();--}}
{{--            var rowId=$(this).data('id');--}}
{{--            var token="{{csrf_token()}}";--}}
{{--            var path="{{route('wishlist.delete')}}";--}}

{{--            $.ajax({--}}
{{--                url:path,--}}
{{--                type:"POST",--}}
{{--                data:{--}}
{{--                    _token:token,--}}
{{--                    rowId:rowId,--}}
{{--                },--}}
{{--                success:function (data) {--}}
{{--                    if(data['status']){--}}
{{--                        $('body #cart_counter').html(data['cart_count']);--}}
{{--                        $('body #wishlist_list').html(data['wishlist_list']);--}}
{{--                        $('body #header-ajax').html(data['header']);--}}
{{--                        swal({--}}
{{--                            title: "Success!",--}}
{{--                            text: data['message'],--}}
{{--                            icon: "success",--}}
{{--                            button: "OK!",--}}
{{--                        });--}}
{{--                    }--}}
{{--                    else{--}}
{{--                        swal({--}}
{{--                            title: "Opps!",--}}
{{--                            text: data['message'],--}}
{{--                            icon: "Something went wrong",--}}
{{--                            button: "OK!",--}}
{{--                        });--}}
{{--                    }--}}
{{--                },--}}
{{--                error:function (err) {--}}
{{--                    swal({--}}
{{--                        title: "Error!",--}}
{{--                        text: "Some error",--}}
{{--                        icon: "error",--}}
{{--                        button: "OK!",--}}
{{--                    });--}}
{{--                }--}}
{{--            })--}}

{{--        })--}}
{{--    </script>--}}
@endsection
