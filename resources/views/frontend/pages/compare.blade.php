@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Compare</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Compare Area  -->
    <div class="compare_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="compare-list">
                        <div class="table-responsive" id="compare">
                                @include('frontend.layouts._compare')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection


@section('scripts')
    <script>     <!-- move item to wishlist script -->
        $(document).on('click','.move-to-wishlist',function(e){
            e.preventDefault();
            var rowId=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('compare.move.wishlist')}}";

            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token:token,
                    rowId:rowId,
                },

                success:function (data) {
                    if(data['status']){
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #compare').html(data['compare_list']);
                        $('body #header-ajax').html(data['header']);
                        swal({
                            title: "Success!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    else{
                        swal({
                            title: "Opps!",
                            text: data['message'],
                            icon: "Something went wrong",
                            button: "OK!",
                        });
                    }
                },
                error:function (err) {
                    swal({
                        title: "Error!",
                        text: "Some error",
                        icon: "error",
                        button: "OK!",
                    });
                }
            })

        })
    </script>
    <script> <!-- delete item in compare list script -->
        $(document).on('click','.delete-compare',function(e){

            e.preventDefault();
            var rowId=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('compare.delete')}}";

            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token:token,
                    rowId:rowId,
                },
                success:function (data) {
                    if(data['status']){
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #compare').html(data['compare_list']);
                        $('body #header-ajax').html(data['header']);
                        swal({
                            title: "Success!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    else{
                        swal({
                            title: "Opps!",
                            text: data['message'],
                            icon: "Something went wrong",
                            button: "OK!",
                        });
                    }
                },
                error:function (err) {
                    swal({
                        title: "Error!",
                        text: "Some error",
                        icon: "error",
                        button: "OK!",
                    });
                }
            })

        })
    </script>
@endsection


