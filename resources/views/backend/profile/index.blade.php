@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
{{--            section header--}}
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Profile</h2>
                    </div>
                </div>
            </div>
{{--            section Form--}}
            <div class="row clearfix">
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
                <div class="col-lg-6 col-md-6">
                    <div class="card card-static-2 mb-30 p-4">
                        <div class="card-title-2">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body-table">
                            <div class="news-content-right pd-20">
                                <form action="{{route('profile.update',auth('admin')->user()->id)}}" id="profile-form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- @method('patch') --}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="first_name" value="{{auth('admin')->user()->first_name}}" placeholder="Enter First Name">
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="last_name" value="{{auth('admin')->user()->last_name}}" placeholder="Enter Last Name">
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" disabled class="form-control" name="email" value="{{auth('admin')->user()->email}}" placeholder="Enter Email Address">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <button class="btn btn-info" id="profile-btn" type="submit"><i class="fas fa-paper-plane"></i> Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card card-static-2 mb-30 p-4">
                        <div class="card-title-2">
                            <h4>Change Password</h4>
                        </div>
                        <div class="card-body-table">
                            <div class="news-content-right pd-20">
                                <form method="POST" action="{{route('update.password')}}" id="form">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="inputPasswordOld">Old Password*</label>
                                        <input class="form-control py-3" id="inputPasswordOld" value="{{old('password')}}" type="password" name="current_password" placeholder="Enter old password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="inputPasswordNew">New Password*</label>
                                        <input class="form-control py-3" id="inputPasswordNew" type="password" name="new_password" placeholder="Enter new password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="inputPasswordNewConfirm">Confirmation Password*</label>
                                        <input class="form-control py-3" id="inputPasswordNewConfirm" type="password" name="new_confirm_password" placeholder="Enter New confirmation password">
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" id="btn" class="btn btn-info">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm1').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
