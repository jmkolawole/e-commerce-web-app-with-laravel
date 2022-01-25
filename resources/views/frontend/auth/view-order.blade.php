@extends('frontend.layouts.master')

@section('content')

    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('user.account')}}">Orders</a></li>
                <li class="breadcrumb-item">ID: {{$order->id}}</li>
            </ol>
        </div>
    </div>

    <div class="checkout-area white-bg pb-90" style="margin-top: 40px!important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Billed To</h3>
                        <div class="form-group">
                            {{$billingDetails->first_name}} {{$billingDetails->last_name}}

                        </div>

                        <div class="form-group">
                            {{$billingDetails->email}}

                        </div>

                        <div class="form-group">
                            {{$billingDetails->address}}
                        </div>

                        <div class="form-group">
                            {{$billingDetails->town}}

                        </div>
                        <div class="form-group">
                            {{$billingDetails->state}}

                        </div>

                        <div class="form-group">
                            {{$billingDetails->country}}

                        </div>

                        <div class="form-group">
                            {{$billingDetails->pincode}}

                        </div>
                        <div class="form-group">
                            {{$billingDetails->phone_number}}

                        </div>



                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Shipped To</h3>
                        <div class="form-group">
                            {{$shippingDetails->first_name}} {{$shippingDetails->last_name}}

                        </div>

                        <div class="form-group">
                            {{$shippingDetails->email}}

                        </div>

                        <div class="form-group">
                            {{$shippingDetails->address}}
                        </div>

                        <div class="form-group">
                            {{$shippingDetails->town}}

                        </div>
                        <div class="form-group">
                            {{$shippingDetails->state}}

                        </div>

                        <div class="form-group">
                            {{$shippingDetails->country}}

                        </div>

                        <div class="form-group">
                            {{$shippingDetails->pincode}}

                        </div>
                        <div class="form-group">
                            {{$shippingDetails->phone_number}}

                        </div>




                    </div>
                </div>


            </div>

            <div class="row" style="margin-top: 40px!important;">

                <div class="col-lg-12 col-md-12">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <div>Order Status: {{$order->order_status}}</div>
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
                                @foreach($order->orders as $product)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{$product->product_name}}
                                            @if($product->attribute_id != 0)
                                                <?php
                                                $name = \App\Attribute::where('id',$product->attribute_id)->first();
                                                ?>
                                                <span>({{$name->color}})</span>
                                            @endif
                                            <span class="product-quantity"> × {{$product->product_qty}}</span>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">₦{{$product->product_price * $product->product_qty}}</span>
                                        </td>
                                    </tr>
                                    <?php
                                    $total_amount = $total_amount + ($product->product_price * $product->product_qty);
                                    ?>
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Order Subtotal</th>
                                    <td><span class="amount">₦{{$total_amount}}</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><span class=" total amount">₦{{$total_amount}}</span>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


<script>


</script>

