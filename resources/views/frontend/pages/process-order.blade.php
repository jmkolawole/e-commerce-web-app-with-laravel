@extends('frontend.layouts.master')
@section('title', " Process Order | Alvins Makeup")

@section('content')

    <div class="checkout-area white-bg pb-90" style="margin-top: 40px!important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Thank You</h3>
                        <div class="form-group">
                            Your Order Is Being Processed. Your Order ID is <b>{{$order_id}}</b><br>
                            And The Total Payable Amount is <b>₦{{$grandTotal}}</b><br>
                            Please do not refresh this page

                            <div class="buttons-cart" style="margin: 10px 0;">
                                <a href="{{route('products')}}">Return Back To Shop</a>
                            </div>
                        </div>

                    </div>
                </div>




            </div>

        </div>
    </div>
 @endsection
