@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Payment Method (PAYPAL)</h2>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
{{--                section notif--}}
                <div class="col-md-12">
                    @include('backend.layouts.notification')

                @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
{{--                section form--}}
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{route('paypal.setting.update')}}" method="post">
                                <input type="hidden" name="payment_method" value="paypal">
                                @method('patch')
                                @csrf
                                <div class="row clearfix">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Paypal Client ID</label>
                                            <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                                            <input type="text" name="PAYPAL_CLIENT_ID" value="{{env('PAYPAL_CLIENT_ID')}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <input type="hidden" name="types[]" value="PAYPAL_CLIENT_SECRET">
                                            <label for="">Paypal CLIENT SECRET</label>
                                            <input type="text" name="PAYPAL_CLIENT_SECRET" value="{{env('PAYPAL_CLIENT_SECRET')}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Paypal Sandbox Mode</label><br>
                                            <input type="checkbox" name="paypal_sandbox" value="1" @if(get_setting('paypal_sandbox')==1) checked @endif>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save changes</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
