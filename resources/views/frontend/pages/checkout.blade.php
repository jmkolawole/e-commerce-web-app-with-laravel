@extends('frontend.layouts.master')
@section('title', 'Check Out | Alvins Makeup')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </div>
    </div>




    <form action="{{route('checkout')}}" method="POST">
        {{csrf_field()}}
    <div class="checkout-area white-bg pb-90" style="margin-top: 40px!important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-sm-30">
                                    <label>First Name <span class="required">*</span></label>
                                    <input type="text" @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->first_name}}" @endif
                                    name="billing_first_name" id="billing_first_name"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Last Name <span class="required">*</span></label>
                                    <input type="text" @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->last_name}}" @endif
                                            name="billing_last_name" id="billing_last_name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="country-select clearfix mb-30">
                                    <label>Country <span class="required">*</span></label>
                                    <select class="wide" name="billing_country" id="billing_country">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)

                                        <option value="{{$country->name}}"
                                                @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) @if($userDetails->country == $country->name) selected="selected"@endif @endif>
                                            {{$country->name}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text"
                                           @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->address}}" @endif
                                           name="billing_address" id="billing_address" placeholder="Address"/>
                                </div>
                            </div>


                            <div class="col-md-12" style="margin-top: 20px!important;">
                                <div class="checkout-form-list mb-30">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" placeholder="Town / City"
                                           @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->town}}" @endif
                                                   name="billing_town" id="billing_town" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>State <span class="required">*</span></label>
                                    <input type="text" placeholder="State"
                                           @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->state}}" @endif
                                           name="billing_state" id="billing_state" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Postcode / Zip</label>
                                    <input type="text" placeholder="Postcode / Zip"
                                           @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->pincode}}" @endif
                                           name="billing_post_code" id="billing_post_code"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" placeholder="Email"
                                           @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->email}}" @endif
                                           name="billing_email" id="billing_email"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Phone Number<span class="required">*</span></label>
                                    <input type="text" placeholder="Phone Number"
                                           @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check()) value="{{$userDetails->phone}}" @endif
                                           name="billing_phone" id="billing_phone"  />
                                </div>
                            </div>
                        </div>
                        <div class="ship-different-title">
                            <h3 style="text-transform: none!important;font-size:.8em!important;">
                                <label style="font-size:1.2em!important;">Shipping Address Same As Billing Address?</label>
                                <input id="auto-fill" type="checkbox"  onclick="fillDetails()"/>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Shipping Details</h3>

                        <div class="">

                            <div id="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-sm-30">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" placeholder=""  name="shipping_first_name" id="shipping_first_name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" placeholder="" name="shipping_last_name" id="shipping_last_name" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="country-select clearfix mb-30">
                                            <label>Country <span class="required">*</span></label>
                                            <select class="wide" name="shipping_country" id="shipping_country">
                                                <option value="bangladesh">Bangladesh</option>
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" placeholder="Street address" name="shipping_address" id="shipping_address" />
                                        </div>
                                    </div>


                                    <div class="col-md-12" style="margin-top: 20px!important;">
                                        <div class="checkout-form-list mb-30">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input type="text" placeholder="Town / City" name="shipping_town" id="shipping_town"  />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>State <span class="required">*</span></label>
                                            <input type="text" placeholder=""  name="shipping_state" id="shipping_state" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Postcode / Zip</label>
                                            <input type="text" placeholder="Postcode / Zip" name="shipping_post_code" id="shipping_post_code"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" placeholder="" name="shipping_email" id="shipping_email"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Phone Number<span class="required">*</span></label>
                                            <input type="text" placeholder="Phone Number" name="shipping_phone" id="shipping_phone"  />
                                        </div>
                                    </div>

                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10" name="note"  placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="send-email float-md-right">
                    <input value="Review My Order" class="return-customer-btn" type="submit">
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection


<script>
    function fillDetails() {


        if (document.getElementById('auto-fill').checked) {


            $("#shipping_first_name").val($("#billing_first_name").val());
            $("#shipping_last_name").val($("#billing_last_name").val());
            $("#shipping_country").val($("#billing_country").val());
            $("#shipping_address").val($("#billing_address").val());
            $("#shipping_town").val($("#billing_town").val());
            $("#shipping_state").val($("#billing_state").val());
            $("#shipping_post_code").val($("#billing_post_code").val());
            $("#shipping_email").val($("#billing_email").val());
            $("#shipping_phone").val($("#billing_phone").val());

        } else {
            $("#shipping_first_name").val('');
            $("#shipping_last_name").val('');
            $("#shipping_country").val('');
            $("#shipping_address").val('');
            $("#shipping_town").val('');
            $("#shipping_state").val('');
            $("#shipping_post_code").val('');
            $("#shipping_email").val('');
            $("#shipping_phone").val('');

        }
    }

</script>