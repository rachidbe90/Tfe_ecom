@extends('frontend.layouts.master')

@section('content')
    <!-- Login Area -->
    <div class="bigshop_reg_log_area py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="login_form mb-50">
                        <h5 class="mb-3">Login</h5>
                        <form action="{{route('login.submit')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="username" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                @error('password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-check">
                                <div class="custom-control custom-checkbox mb-3 pl-1">
                                    <input type="checkbox" class="custom-control-input" id="customChe">
                                    <label class="custom-control-label" for="customChe">Remember me for this computer</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">Login</button>
                        </form>
                        <!-- Forget Password -->
                        <div class="forget_pass mt-15">
                            <a href="{{route('password.request')}}">Forget Password?</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="login_form mb-50">
                        <h5 class="mb-3">Register</h5>

                        <form action="{{route('register.submit')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="first_name" id="firstname" placeholder="First Name" value="{{old('first_name')}}">
                                @error('first_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" id="lastname" placeholder="Last Name" value="{{old('Last_name')}}">
                                @error('Last_name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{old('username')}}">
                                @error('username')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">

                                @error('password')
{{--                                <p class="text-danger">{{$message}}</p>--}}
                                <p class="text-danger">Your password must be more 8 characters long, should contain at-least 1 Uppercase, 1Lowercase, 1 Numeric and special character</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="Repeat Password">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="cgu" id="cgu" /> <label for="cgu">I accept the general <a href="{{route('condition')}}">Terms of use</a></li> of AyaMarket</label>
                            </div>

                            <button type="submit" class="btn btn-info" id="submitButton" style="display:none;">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End -->
@endsection
@section('scripts')
    <script type="text/javascript"> {{-- Accept condition --}}
        // <![CDATA[
        window.onload = function() {
            var cgu = document.getElementById('cgu');
            var submitButton = document.getElementById('submitButton');

            cgu.onchange = function() {
                submitButton.style.display = (cgu.checked == true) ? 'inline' : 'none';
            };
        };
        // ]]>
    </script>
@endsection

