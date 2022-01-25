@extends('frontend.layouts.master')



@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Reset Password</li>
            </ol>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <div class="login ptb-90">
        <div class="container">
            <h3 class="login-header">Type Your New Password</h3>
            <div class="row">
                <div class="col-xl-6 col-lg-8 offset-xl-3 offset-lg-2">
                    <div class="login-form">
                        <form action="{{route('password.reset')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="token" value="{{$tokenData->token}}">
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="email" value="{{$tokenData->email}}" id="email" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="inputPassword"
                                           placeholder="Password" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="inputPassword"
                                           placeholder="Password" name="password_confirmation">
                                </div>
                            </div>

                            <div class="login-details text-center mb-25">
                                <button type="submit" class="login-btn">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection




