@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
{{--            section header--}}
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Products</h2>
                        <ul class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Product attribute</li>
                        </ul>
                    </div>
                </div>
            </div>
{{--            section form--}}
            <div class="row clearfix">
                <div class="col-lg-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @include('backend.layouts.notification')
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ucfirst($product->title)}}</strong></h2>
                            <div class="row">
                                <div class="col-md-7">
                                    <form action="{{route('product.attribute',$product->id)}}" method="post">
                                        @csrf
                                        <div id="product_attribute" class="content" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>

                                            <div class="row group">
                                                <div class="col-lg-12 col-sm-12">
                                                    <label for="size">Size</label>
                                                    <select name="size" class="form-control" required>
                                                        <option value="s" {{old('size')=='s' ? 'selected' : ''}}>S</option>
                                                        <option value="m" {{old('size') =='m' ? 'selected' : ''}} >M</option>
                                                        <option value="l" {{old('size')=='l' ? 'selected' : ''}}>L</option>
                                                        <option value="xl" {{old('size') =='xl' ? 'selected' : ''}} >Xl</option>
                                                        <option value="Uni" {{old('size') =='Uni' ? 'selected' : ''}} >Unique</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Stock</label>
                                                    <input required class="form-control form-control-sm" name="stock[]" placeholder="eg. 4" type="number">
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="mt-4btn btn-sm btn-danger btnRemove"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-info">Submit</button>
                                        <a href="{{route('product.index')}}" class="btn btn-sm btn-warning">back</a>

                                    </form>
                                </div>
                                <div class="col-md-5">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Stock</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($productattr)>0)
                                                    @foreach($productattr as $item)
                                                        <tr>
                                                            <td>{{$item->size}}</td>
                                                            <td>{{$item->stock}}</td>
                                                            <td><form class="float-left ml-1" action="{{route('product.attribute.destroy',$item->id)}}"  method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <a href="" data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i> </a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('backend/assets/js/jquery.multifield.min.js')}}"></script>
    <script>
        $('#product_attribute').multifield();
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script> // delete attribut
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
