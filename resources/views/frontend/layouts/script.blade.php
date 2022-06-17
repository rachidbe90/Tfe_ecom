<!-- Js Plugins -->
<script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->
<script src="{{asset('frontend')}}/js/jquery-ui.min.js"></script>
<script src="{{asset('frontend')}}/js/jquery.slicknav.js"></script>
<script src="{{asset('frontend')}}/js/mixitup.min.js"></script>
<script src="{{asset('frontend')}}/js/bootstrap-notify.js"></script>
<script src="{{asset('frontend')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('frontend')}}/js/main.js"></script>

<script src="{{asset('frontend')}}/js/bootstrap.min.js"></script>

<script>
   @if(\Illuminate\Support\Facades\Session::has('success'))
       $.notify("Success: {{\Illuminate\Support\Facades\Session::get('success')}}", {
           animate: {
               enter: 'animated fadeInRight',
               exit: 'animated fadeOutRight'
           }
       });
    @endif
    @php
        \Illuminate\Support\Facades\Session::forget('success')
    @endphp

    @if(\Illuminate\Support\Facades\Session::has('error'))
    $.notify("Sorry: {{\Illuminate\Support\Facades\Session::get('error')}}", {
        animate: {
            enter: 'animated fadeInRight',
            exit: 'animated fadeOutRight'
        }
    });
    @endif
    @php
        \Illuminate\Support\Facades\Session::forget('error')
    @endphp
</script>
@yield('scripts')
<script>
    setTimeout(function(){
        $('#alert').slideUp();
    },4000);
</script>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $(document).on('click','.cart_delete',function(e){
        e.preventDefault();
        var cart_id=$(this).data('id');
        var token="{{csrf_token()}}";
        var path="{{route('cart.delete')}}";

        $.ajax({
            url:path,
            type:"POST",
            dataType:"JSON",
            data:{
                cart_id:cart_id,
                _token:token,
            },
            success:function (data) {
                console.log(data);

                if(data['status']){
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
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

<script>
    function currency_change(currency_code) {
        $.ajax({
            type:'POST',
            url:'{{route('currency.load')}}',
            data:{
                currency_code:currency_code,
                _token: '{{csrf_token()}}',
            },
            success:function (response) {
                if(response['status']){
                    location.reload();
                }
                else{
                    alert('server error');
                }
            }
        })
    }
</script>


{{--Add to cart--}}
<script>
    $(document).on('click', '.add_to_cart', function (e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');
        var product_price = $(this).data('price');
        var token = "{{csrf_token()}}";
        var path = "{{route('cart.store')}}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                product_qty: product_qty,
                product_price: product_price,
                _token: token,
            },

            success: function (data) {
                console.log(data);

                if (data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
                    swal({
                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        button: "OK!",
                    });

                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
</script>

{{--Add to wishlist--}}
<script>
    $(document).on('click', '.add_to_wishlist', function (e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var product_qty = $(this).data('quantity');

        var token = "{{csrf_token()}}";
        var path = "{{route('wishlist.store')}}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            success: function (data) {
                console.log(data);

                if (data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    swal({
                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        button: "OK!",
                    });

                } else if (data['present']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    swal({
                        title: "Opps!",
                        text: data['message'],
                        icon: "warning",
                        button: "OK!",
                    });
                } else {
                    swal({
                        title: "Sorry!",
                        text: "You can't add that product",
                        icon: "error",
                        button: "OK!",
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
</script>

<script>

    $('.qty-text ').change('key up',function () {
        var id=$(this).data('id');
        var spinner=$(this),input=spinner.closest('div.quantity').find('input[type="number"]');
        var newVal=parseFloat(input.val());
        $('#add_to_cart_button_details_'+id).attr('data-quantity',newVal);

    });

    $(document).on('click','.add_to_cart_button_details',function (e) {
        e.preventDefault();
        var product_qty=$(this).data('quantity');
        var product_id=$(this).data('product_id');
        var product_size=$(this).data('size');
        var product_price=$(this).data('price');
        var token="{{csrf_token()}}";
        var path="{{route('cart.store')}}";

        if(product_size ==null){
            alert('The size field is required.');
        }
        if(product_size !=null && product_id !=null){
            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token:token,
                    product_id:product_id,
                    product_size:product_size,
                    product_price:product_price,
                    product_qty:product_qty,
                },
                success:function (data) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
                    if(data['status']){
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    else{
                        swal({
                            title: "Sorry!",
                            text: data['message'],
                            icon: "error",
                            button: "OK!",
                        });
                    }
                    window.location.href=window.location.href;


                },
                error:function (err) {
                    console.log(err);
                }
            });

        }
    });
</script>

{{--Add to compare--}}
<script>
    $(document).on('click', '.add_to_compare', function (e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var token = "{{csrf_token()}}";
        var path = "{{route('compare.store')}}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                _token: token,
            },
            success: function (data) {
                console.log(data);

                if (data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #compare_counter').html(data['compare_count']);
                    swal({
                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        button: "OK!",
                    });

                } else if (data['present']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #compare_counter').html(data['compare_count']);
                    swal({
                        title: "Opps!",
                        text: data['message'],
                        icon: "warning",
                        button: "OK!",
                    });
                } else {
                    swal({
                        title: "Sorry!",
                        text: data['message'],
                        icon: "error",
                        button: "OK!",
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
</script>




