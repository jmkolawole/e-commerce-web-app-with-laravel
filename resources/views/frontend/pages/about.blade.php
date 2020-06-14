@extends('frontend.layouts.master')
@section('title', 'About Us | Alvins Makeup')
@section('description', 'Alvins Makeup Is One Of The Best Makeup, Cosmetics And Beauty Stores In Nigeria. You Can Buy Original
Products From Your Favourite Brands At AlvinsMakeup')
@section('keywords', 'Alvins Makeup Nigeria: Buy Makeup, Cosmetics And Skincare')
@section('og_title','About US | Alvins Makeup')
@section('og_url',url('/about'))
@section('og_description','Alvins Makeup Nigeria: Buy Makeup, Cosmetics And Skincare')
<?php
$image = \App\Banner::where('id',1)->first();
?>
@section('og_image',asset('images/backend/banners/'.$image->banner1))


@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">about us</li>
            </ol>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- About Us Area Start -->
    <div class="skill-area white-bg ptb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content mb-all-40">
                        <!-- Section Title Start -->
                        <div class="about-title">
                            <h3>about Alvins Makeup</h3>
                        </div>
                        <!-- Section Title End -->
                        <p class="mb-15">Welcome to Alvins Makeup. Your number one source for all things makeup and female acessories.
                        We are dedicated to giving you the very best make up items and accessories with a keen focus on dependability, cost, customer service
                        and uniqueness</p>
                        <p>We hope you'll greatly enjoy our products as much as we enjoy offering them to you</p>
                        <a class="login-btn" href="#">Read more</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="our-team dark-white-bg ptb-90">
        <div class="container">
            <div class="about-title team-title">
                <h3>our team</h3>
            </div>
            <div class="row text-center">

                <!-- Single Team Start Here -->
                @foreach($teams as $team)
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="single-team mb-all-30">
                        <div class="team-img sidebar-img sidebar-banner">
                            <a href="#"><img src="{{asset('images/backend/teams/small/' . $team->image)}}" alt="team-image"></a>
                            <div class="team-link">
                                <ul>
                                    <li><a href="//{{$team->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="//{{$team->twitter}}"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="//{{$team->instagram}}"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4>{{$team->name}}</h4>
                            <p>{{$team->title}}</p>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>


 @endsection