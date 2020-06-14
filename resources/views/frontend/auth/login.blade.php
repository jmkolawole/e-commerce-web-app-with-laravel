@extends('frontend.layouts.master')



@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Login</li>
            </ol>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <div class="login ptb-90">
        <div class="container">
            <h3 class="login-header">Log in to your account </h3>
            <div class="row">
                <div class="col-xl-6 col-lg-8 offset-xl-3 offset-lg-2">
                    <div class="login-form">
                        <form action="{{route('post.login.user')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="inputPassword"
                                           placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="login-details text-center mb-25">
                                <a href="{{route('forgot.password')}}">Forgot your password? </a>
                                <button type="submit" class="login-btn">Sign in</button>
                            </div>
                            <div class="login-footer text-center">
                                <p>No account? <a href="{{route('register.user')}}">Create one here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection



