@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
{{--                section notif--}}
                <div class="col-lg-12">
                    @include('backend.layouts.notification')
                </div>
                <div class="col-lg-12">
                    <div class="card mt-4">
                        <div class="row p-4">
{{--                            section list--}}
                            <div class="col-lg-6 col-sm-6">
                                <div class="ordr-date">
                                    <b>Order Date :</b> {{\Carbon\Carbon::parse($order->created_at)->format('d F, Y')}}<br>
                                    <b>OrderID :</b> {{$order->order_number}}<br>
                                    <b>Name :</b> {{ucfirst($order->first_name)}} {{ucfirst($order->last_name)}}<br>
                                    <b>Phone number :</b> {{$order->phone}}<br>
                                    <b>Email Address :</b> {{$order->email}}<br>
                                </div>
                            </div>
{{--                            section view item details--}}

                            <div class="col-lg-6 col-sm-6">
                                <div class="ordr-date">
                                    <b>Bill Address :</b><br>
                                    {{$order->street}},
                                    {{$order->city}},<br>
                                    {{$order->num}},
                                    {{$order->country}},<br>
                                    {{$order->postcode}}<br>
                                </div>
                            </div>
                        </div>
                        <hr>
{{--                        order detail--}}
                        <div class="header">
                            <h2><strong>Order</strong> List</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped ">
                                    <thead >
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$order->first_name}} {{$order->last_name}}</td>
                                            <td>{{$order->email}}</td>
                                            <td>{{$order->payment_method=="cod" ? "Cash on Delivery" : $order->payment_method}}</td>
                                            <td>{{ucfirst($order->payment_status)}}</td>
                                            <td>€ {{number_format($order->total_amount,2)}}</td>
                                            <td><span class="badge
                                            @if($order->condition=='pending')
                                                    badge-info
                                            @elseif($order->condition=='processing')
                                                    badge-primary
                                            @elseif($order->condition=='delivered')
                                                    badge-success
                                            @else
                                                    badge-danger
                                            @endif
                                                    ">{{$order->condition}}</span></td>
                                            <td>
{{--                                                <a href="{{route('order.show',$order->id)}}" data-toggle="tooltip" title="download" class="float-left btn btn-sm btn-outline-warning" data-placement="bottom"><i class="fas fa-download"></i> </a>--}}
                                                <form class="float-left ml-1" action="{{route('order.destroy',$order->id)}}"  method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" data-toggle="tooltip" title="delete" data-id="{{$order->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i> </a>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                {{--products detail in order--}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped ">
                                    <thead >
                                    <tr>
                                        <th>S.N</th>
                                        <th>Product Image</th>
                                        <th>Product</th>
                                        <th>Product size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->products as $item)
                                    <tr>
                                        <td></td>
                                        <td><img src="{{asset($item->photo)}}" style="max-width: 100px"> </td>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            {{$item->pivot->size}}
                                        </td>
                                        <td>{{$item->pivot->quantity}}</td>
                                        <td>€ {{number_format($item->pivot->price,2)}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-5 border py-3">
                                <p>
                                    <strong>Subtotal</strong>: € {{number_format($order->sub_total,2)}}
                                </p>
                                @if($order->delivery_charge>0)
                                <p>
                                    <strong>Shipping cost</strong>:  € {{number_format($order->delivery_charge,2)}}
                                </p>
                                @endif
                                @if($order->coupon>0)
                                <p>
                                    <strong>Coupon</strong>: € {{number_format($order->coupon,2)}}
                                </p>
                                @endif
                                <p>
                                    <strong>TVA</strong>: 21%
                                </p>
                                <p>
                                    <strong>Total</strong>: € {{number_format($order->total_amount,2)}}
                                </p>

                                <form action="{{route('order.status')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <strong>Status</strong>
                                    <select name="condition" class="form-control" id="">
                                        <option value="pending" {{$order->condition=='delivered' || $order->condition=='cancelled' ? 'disabled' : ''}} {{$order->condition=='pending'? 'selected' : ''}}>Pending</option>
                                        <option value="processing" {{$order->condition=='delivered' || $order->condition=='cancelled' ? 'disabled' : ''}} {{$order->condition=='processing'? 'selected' : ''}}>Processing</option>
                                        <option value="delivered" {{$order->condition=='cancelled' ? 'disabled' : ''}} {{$order->condition=='delivered'? 'selected' : ''}}>Delivered</option>

                                        <option value="cancelled" {{$order->condition=='delivered' ? 'disabled' : ''}} {{$order->condition=='cancelled'? 'selected' : ''}}>Cancelled</option>
                                    </select>
                                    <button class="btn btn-sm btn-success">Update</button>
                                </form>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script> // delete item
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function (e) {
            var form=$(this).closest('form');
            var dataID=$(this).data('id');
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

        });
    </script>
    <script> // status change
        $('input[name=toogle]').change(function () {
            var mode=$(this).prop('checked');
            var id=$(this).val();
            // alert(id);
            $.ajax({
                url:"{{route('coupon.status')}}",
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}',
                    mode:mode,
                    id:id,
                },
                success:function (response) {
                    if(response.status){
                        alert(response.msg);
                    }
                    else{
                        alert('Please try again!');
                    }
                }
            })
        });
    </script>
@endsection
