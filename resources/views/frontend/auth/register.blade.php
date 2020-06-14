@extends('frontend.layouts.master')



@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Register</li>
            </ol>
        </div>
    </div>


    <div class="register-area ptb-90">
        <div class="container">
            <h3 class="login-header">Create an account </h3>
            <div class="row">
                <div class="offset-xl-1 col-xl-10">
                    <div class="register-form login-form clearfix">
                        <form action="{{route('register.user')}}" method="POST">
                            {{csrf_field()}}
                            <p>Already have an account? <a href="{{route('login.user')}}">Log in instead!</a></p>

                            <div class="form-group row">
                                <label for="f-name" class="col-lg-3 col-md-3 col-form-label">First Name</label>
                                <div class="col-lg-6 col-md-6">
                                    <input type="text" class="form-control" id="f-name" name="first_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="l-name" class="col-lg-3 col-md-3 col-form-label">Last Name</label>
                                <div class="col-lg-6 col-md-6">
                                    <input type="text" class="form-control" id="l-name" name="last_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-lg-3 col-md-3 col-form-label">Email</label>
                                <div class="col-lg-6 col-md-6">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-lg-3 col-md-3 col-form-label">Password</label>
                                <div class="col-lg-6 col-md-6">
                                    <input type="password" class="form-control" id="inputPassword" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-lg-3 col-md-3 col-form-label">Confirm Password</label>
                                <div class="col-lg-6 col-md-6">
                                    <input type="password" class="form-control" id="inputPassword" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-check row p-0 mt-20">
                                <div class="col-md-8 offset-md-3">
                                    <input class="form-check-input" id="subscribe" type="checkbox" name="newsletter">
                                    <label class="form-check-label" for="subscribe">Sign up for our
                                        newsletter<br>Subscribe to our newsletters now and stay up-to-date with new
                                        collections, the latest products and exclusive offers..</label>
                                </div>
                            </div>
                            <div class="register-box mt-40">
                                <button type="submit" class="login-btn float-right">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


