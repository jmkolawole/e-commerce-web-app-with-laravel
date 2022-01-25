
@extends('frontend.layouts.master')
@section('title', 'Cart | Alvins Makeup')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </div>
    </div>


    <div class="cart-main-area  ptb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">


                    <div class="about-title mb-20">
                    <h2 class="text-center" style="font-weight: bold">@if($userCart->count() == 0)Nothing In Your Cart @else Cart Items @endif</h2>
                    </div>


                    <div class="table-content table-responsive mb-45">
                        <table>

                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Action</th>
                            </tr>
                            </thead>


                            <tbody>

                            <?php
                            $total_amount = 0;



                            ?>
                @if($userCart->count() != 0)
                @foreach($userCart as $product)

                    <tr>
                        <?php

                        $price = 0;
                        $item = \App\Product::where('id',$product->product_id)->first();
                        $status = \App\Product::where('id',$product->product_id)->where('status',1)->first();

                        if($status)
                            {
                        if($item){
                        $price = $item->price;


                        // $image = \App\Product::where('id',$product->product_id)->first();

                        ?>

                        <td class="product-thumbnail">
                            <a href="{{route('product',$item->url)}}"><img src="{{asset('images/backend/products/small/'.$item->image)}}" alt="cart-image" /></a>
                        </td>

                        <td class="product-name"><a href="" >{{$product->product_name}}</a><br
                            @if($product->attribute_id != 0)
                                <?php
                                $name = \App\Attribute::where('id',$product->attribute_id)->first();
                                ?>
                                @if($name)
                                    <span>({{$name->color}})</span>
                                @endif
                            @endif
                            @if($item->status == 0)<p style="color: red">
                                Disabled Product. Please Remove From Cart
                            </p>@endif
                        </td>

                        <td class="product-price"><span class="amount">₦{{$price}}</span></td>

                        <style>
                            .update-btn{
                                display:inline!important;
                                font-size:.9em!important;
                                background: #303030!important;
                                padding:0 2px 0 2px!important;
                                color: white!important;
                                height: 30px!important;
                                margin-bottom:3px!important;
                            }
                            .update-btn:hover{
                                background: #c7b270!important;
                            }
                        </style>
                        <form action="{{route('update.cart')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <td class="product-quantity"><input type="number" name="quantity" value="{{$product->quantity}}"></td>

                            <td class="product-subtotal">₦{{$price * $product->quantity}}</td>
                            <td class="product-remove">
                                <input type="submit" class="login-btn update-btn" value="Update">

                        </form>

                        <form style="display: inline!important;" action="{{route('remove.cart')}}" method="POST" name="myForm{{$product->id}}" id="myForm{{$product->id}}">
                            {{csrf_field()}}
                            <?php
                            $id = $product->id;
                            ?>
                            <input type="hidden" name="cart_id" value="<?php echo $id?>">
                            <button href="#" class="btn btn-danger" type="button" onclick="removeItem({{$product->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                        </form>

                        </td>

                        <?php

                        }
                            }


                        ?>



                    </tr>
                    <?php


                    if ($item->status != 0){
                    $total_amount = $total_amount + ($price * $product->quantity);
                    }
                    ?>
                    @endforeach
                @endif
                            </tbody>
                        </table>



                    </div>


                        <div class="row">
                            <!-- Cart Button Start -->
                            <div class="col-md-8 col-sm-12">
                                <div class="buttons-cart">
                                    <a href="{{route('products')}}">Continue Shopping</a>
                                </div>
                            </div>

                            <!-- Cart Button Start -->
                            <!-- Cart Totals Start -->
                            @if($userCart->count() != 0)
                            @if($status && isset($status))
                                <div class="col-md-4 col-sm-12">
                                    <div class="cart_totals float-md-right text-md-right">
                                        <h2>Cart Totals</h2>
                                        <br />
                                        <table class="float-md-right">
                                            <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td><span class="amount">₦{{$total_amount}}</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    <strong><span class="amount">₦{{$total_amount}}</span></strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div class="wc-proceed-to-checkout">
                                            <a href="{{route('checkout')}}">Proceed to Checkout</a>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @endif
                        <!-- Cart Totals End -->
                        </div>


                </div>

            </div>
        </div>
    </div>


@endsection

