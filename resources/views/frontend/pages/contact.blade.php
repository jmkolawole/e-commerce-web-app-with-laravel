


@extends('frontend.layouts.master')
@section('title', 'Contact Us | Alvins Makeup')
@section('description', 'Contact Us At Alvins Makeup For Enquiries on Authentic Makeup, Beauty And Cosmetic Products')
@section('keywords', 'Alvins Makeup Nigeria: Contact Us, Makeup, Cosmetics And Skincare')
@section('og_title','Contact Us | Alvins Makeup')
@section('og_url',url('/contact'))
@section('og_description','Contact Alvins Makeup For Enquiries on Authentic Makeup Products')
<?php
$image = \App\Banner::where('id',1)->first();
?>
@if($image)
@section('og_image',asset('images/backend/banners/'.$image->banner2))
@endif

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Google Map Start -->

    <div class="google-map">
        <div id="map"></div>
    </div>
    <!-- Google Map End -->
    <!-- Regester Page Start Here -->
    <div class="register-area white-bg ptb-90">
        <div class="container">
            <h3 class="login-header">Contact us</h3>
            <div class="row">
                <div class="col-xl-12">
                    <div class="register-contact  clearfix">
                        <form id="contact-form" class="contact-form" action="" method="POST">
                            {{csrf_field()}}
                            <div class="address-wrapper row">
                                <div class="col-md-6">
                                    <div class="address-fname">
                                        <input class="form-control" type="text" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-email">
                                        <input class="form-control" type="email" name="email" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="address-subject">
                                        <input class="form-control" type="text" name="subject"
                                               placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="address-textarea">
                                            <textarea name="message" class="form-control"
                                                      placeholder="Write your message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-content mail-content clearfix">
                                <div class="send-email float-md-right">
                                    <input value="Submit" class="return-customer-btn" type="submit">
                                </div>
                            </div>
                            <p class="form-message"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Page End Here -->
    <!-- Footer Area Start Here -->
@endsection


<script>
    function initMap() {
        var myLatLng = {lat: 8.480003, lng: 4.538651};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: myLatLng
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!'
        });
    }

</script>
<script defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvEwOkdPIvwy6ZVLAyKlcmI2ubtspJE-s&callback=initMap">
</script>
