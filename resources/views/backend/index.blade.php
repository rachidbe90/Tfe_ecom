@extends('backend.layouts.master')

@section('content')

    <div id="main-content">
        <div class="container-fluid">
{{--            section header--}}
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">eCommerce</li>
                        </ul>
                    </div>
                </div>
            </div>
{{--            section list--}}
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{\App\Models\Category::where('status','active')->count()}} <i class="fas fa-sitemap float-right"></i></h3>
                            <span><a href="{{route('category.index')}}">Total Category</a></span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                            <div class="progress-bar" data-transitiongoal="64"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{\App\Models\Product::where('status','active')->count()}} <i class="fas fa-suitcase float-right"></i></h3>
                            <span><a href="{{route('product.index')}}">Total products</a></span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-green m-b-0">
                            <div class="progress-bar" data-transitiongoal="68"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{\App\Models\User::where('status','active')->count()}} <i class="fas fa-user-plus float-right"></i></h3>
                            <span><a href="{{route('user.index')}}">New Customers</a></span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-purple m-b-0">
                            <div class="progress-bar" data-transitiongoal="67"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>€ {{\App\Models\Order::where('condition','delivered')->sum('total_amount')}} <i class="fas fa-money-bill-alt float-right"></i></h3>
                            <span><a href="{{route('order.index')}}">Net Profit</a></span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                            <div class="progress-bar" data-transitiongoal="89"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Recent Orders</h2>
                            <ul class="header-dropdown">
                                <a href="{{route('order.index')}}" class="btn btn-success btn-sm">view all</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead >
                                    <tr>
                                        <th style="width:60px;">S.N.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($orders as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->first_name}} {{$item->last_name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->payment_method=="cod" ? "Cash on Delivery" : $item->payment_method}}</td>
                                            <td>{{ucfirst($item->payment_status)}}</td>
                                            <td>€ {{number_format($item->total_amount,2)}}</td>
                                            <td><span class="badge
                                            @if($item->condition=='pending')
                                                    badge-info
                                            @elseif($item->condition=='processing')
                                                    badge-primary
                                            @elseif($item->condition=='delivered')
                                                    badge-success
                                            @else
                                                    badge-danger
                                            @endif
                                                    ">{{$item->condition}}</span></td>
                                            <td>
                                                <a href="{{route('order.show',$item->id)}}" data-toggle="tooltip" title="view" class="float-left btn btn-sm btn-outline-warning" data-placement="bottom"><i class="fas fa-eye"></i> </a>
                                                <form class="float-left ml-1" action="{{route('order.destroy',$item->id)}}"  method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i> </a>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty

                                    <tr>
                                        <td colspan="8" class="text-center">No orders</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
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
@endsection
