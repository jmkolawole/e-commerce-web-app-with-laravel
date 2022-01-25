@extends('frontend.layouts.master')
@section('title', " Review Order | Alvins Makeup")

@section('content')

    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Process Order</li>
            </ol>
        </div>
    </div>

    <div class="coupon-area white-bg pt-90 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="coupon-accordion">
                        <!-- Accordion Start -->

                        <h3>@if(empty(Session::get('CouponAmount'))) Do You Have A Coupon? <span id="showcoupon">Click Here To Enter Your Code</span>@else
                            <a href="{{route('forget.coupon')}}">Forget Coupon</a>
                            @endif</h3>
                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form action="{{route('apply.coupon')}}" method="POST">
                                    {{csrf_field()}}
                                    <p class="checkout-coupon">
                                        <input type="text" class="code" name="coupon_code" placeholder="Coupon code" />
                                        <input type="submit" value="Apply Coupon" />
                                    </p>
                                </form>
                            </div>
                        </div>
                        <!-- ACCORDION END -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form action="" method="POST">
        {{csrf_field()}}
        <div class="checkout-area white-bg pb-90" style="margin-top: 40px!important;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="checkbox-form mb-sm-40">
                            <h3>Bill To</h3>
                            <div class="form-group">
                                {{$billingDetails[2]}} {{$billingDetails[3]}}

                            </div>
                            <div class="form-group">
                                {{$billingDetails[4]}}

                            </div>

                            <div class="form-group">
                                {{$billingDetails[5]}}

                            </div>


                            <div class="form-group">
                                {{$billingDetails[6]}}

                            </div>


                            <div class="form-group">
                                {{$billingDetails[7]}}
                            </div>

                            <div class="form-group">
                                {{$billingDetails[8]}}
                            </div>

                            <div class="form-group">
                                {{$billingDetails[10]}}
                            </div>



                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="checkbox-form mb-sm-40">
                            <h3>Ship To</h3>
                            <div class="form-group">
                                {{$shippingDetails[2]}} {{$shippingDetails[3]}}

                            </div>
                            <div class="form-group">
                                {{$shippingDetails[4]}}

                            </div>

                            <div class="form-group">
                                {{$shippingDetails[5]}}

                            </div>


                            <div class="form-group">
                                {{$shippingDetails[6]}}

                            </div>


                            <div class="form-group">
                                {{$shippingDetails[7]}}
                            </div>

                            <div class="form-group">
                                {{$shippingDetails[8]}}
                            </div>

                            <div class="form-group">
                                {{$shippingDetails[10]}}
                            </div>

                            <hr>
                            <div class="form-group">
                                {{$shippingDetails[11]}}
                            </div>



                        </div>
                    </div>


                </div>

                <div class="row" style="margin-top: 40px!important;">

                    <div class="col-lg-12 col-md-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $total_amount = 0;
                                    ?>
                                    @foreach($cart_products as $product)
                                        <?php
                                        $price = 0;
                                        $item = \App\Product::where('id',$product->product_id)->first();
                                     if($item){

                                        $price = $item->price;

                                        ?>
                                        @if($item->status != 0)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{$product->product_name}}
                                            @if($product->attribute_id != 0)
                                                <?php
                                                $name = \App\Attribute::where('id',$product->attribute_id)->first();
                                                ?>
                                               @if($name)
                                                <span>({{$name->color}})</span>
                                                @endif
                                              @endif
                                            <span class="product-quantity"> × {{$product->quantity}}</span>
                                        </td>

                                        <td class="product-total">
                                            <span class="amount">₦{{$price * $product->quantity}}</span>
                                        </td>

                                    </tr>
                                        @endif
                                    <?php
                                    }
                                    if ($item->status != 0){
                                        $total_amount = $total_amount + ($price * $product->quantity);
                                    }
                                    ?>
                                     @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">₦{{$total_amount}}</span></td>
                                    </tr>

                                    <?php
                                    if(!empty(Session::get('CouponAmount'))){
                                    $coupon_amount = Session::get('CouponAmount');
                                    }
                                    else{
                                        $coupon_amount = 0;
                                    }
                                    if(!empty(Session::get('CouponRate'))){
                                        $rate = Session::get('CouponRate');
                                        $coupon_rate = "($rate)%";
                                    }else{
                                        $coupon_rate = "";
                                    }

                                    ?>



                                    <tr>
                                        <th>Coupon Discount</th>
                                        <td><span class=" total amount">@if($coupon_amount)-@endif  ₦{{$coupon_amount}} {{$coupon_rate}}</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><span class=" total amount">₦{{$total_amount - $coupon_amount}}</span>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>



                            <div class="payment-method">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingone">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse"
                                                        data-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    Process My Order
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingone"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <p>You'll Be Contacted Shortly By Our Representative. Please Make Payment Directly To Our Account. Only Payments Validate Orders.
                                                </p>
                                                <p>
                                                <div class="wc-proceed-to-checkout">
                                                    <a href="{{route('process.order')}}">Process My Order</a>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

