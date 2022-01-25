
@extends('frontend.layouts.master')
@section('title', 'Cart | Alvins Makeup')


@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Wishlist</li>
            </ol>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Wish List Start -->
    <div class="cart-main-area wish-list white-bg ptb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- Form Start -->
                    <form action="#">
                        <!-- Table Content Start -->
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-remove">Remove</th>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Unit Price</th>
                                    <th class="product-quantity">Stock Status</th>
                                    <th class="product-subtotal">add to cart</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $product)
                                <tr id="wish-to-cart{{$product->product_id}}" class="delete{{$product->id}}">
                                    <?php
                                    $image = \App\Product::where('id',$product->product_id)->first();

                                    $attr = $product->attribute_id;


                                    ?>
                                        <input type="hidden" name="price" value="{{$product->price}}" id="price{{$product->product_id}}">
                                        <input type="hidden" name="product_name" value="{{$product->product_name}}" id="product_name{{$product->product_id}}">
                                        <input type="hidden" name="product_code" value="{{$product->product_code}}" id="product_code{{$product->product_id}}">
                                        <input type="hidden" name="product_attr" value="{{$attr}}" id="product_attr{{$product->product_id}}{{$product->attribute_id}}">
                                    <td class="product-remove"> <a href="#" onclick="deleteList({{$product->id}})"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="{{route('product',$image->url)}}"><img src="{{asset('images/backend/products/small/'.$image->image)}}" alt="cart-image" /></a>
                                    </td>
                                    <td class="product-name"><a href="">{{$product->product_name}}</a>
                                        @if($product->attribute_id != 0)
                                            <?php
                                            $name = \App\Attribute::where('id',$product->attribute_id)->first();
                                            ?>
                                            <span>({{$name->color}})</span>
                                        @endif
                                    </td>
                                    <td class="product-price"><span class="amount">₦{{$product->price}}</span></td>
                                    <td class="product-stock-status"><span>
                                            <?php
                                            $stock = 0;
                                            $item = \App\Product::where('id',$product->product_id)->first();
                                            if ($item->stock_status == "yes"){
                                                $pd = \App\Attribute::where('id',$product->attribute_id)->first();
                                                $stock = $pd->stock;
                                            }else{
                                                $stock = $item->stock;
                                            }

                                            ?>
                                                @if($stock > 0)In Stock @else Out of Stock @endif
                                        </span></td>
                                    <td class="product-add-to-cart"><a href="#" onclick="wishToCart({{$product->product_id}},{{$product->attribute_id}})">add to cart</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Table Content Start -->
                    </form>
                    <!-- Form End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Wish List End -->


@endsection

