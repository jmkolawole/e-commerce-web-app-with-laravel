@extends('frontend.layouts.master')
@section('title', 'Compare | Alvins Makeup')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Compare</li>
            </ol>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Compare Product Start Here -->
    <div class="compare-product ptb-90">
       @if($products->count() == 0)
            <div class="about-title mb-20">
                <h2 class="text-center" style="font-weight: bold">Nothing In Your Compare Selection</h2>
            </div>
        @elseif($products->count() == 1)
            <div class="about-title mb-20">
                <h2 class="text-center" style="font-weight: bold">Nothing To Compare With. Add One More Product</h2>
            </div>
        @else
            <div class="container">
                <div class="table-responsive-sm">
                    <table class="table text-center compare-content">
                        <tbody>
                        <tr>
                            <td class="product-title" style="max-width: 80px!important;">Product</td>

                            @foreach($products as $product)
                                <td class="product-description">
                                    <div class="item_{{$product->product_id}}_{{$product->attribute_id}}">
                                        <div class="compare-details">
                                            <?php
                                            $item = \App\Product::where('id',$product->product_id)->first();
                                            $cat = \App\Category::where('id',$item->category_id)->first();
                                            $name = \App\Attribute::where('id',$product->attribute_id)->first();
                                            ?>
                                            <div class="compare-detail-img">
                                                <a href="#"><img src="{{asset('images/backend/products/small/'.$item->image)}}" alt="compare-product"></a>
                                            </div>
                                            <div class="compare-detail-content">
                                                <h4><a href="{{route('product',$item->url)}}">{{$product->product_name}}@if($name)<span> ({{$name->color}})</span>@endif</a></h4>

                                                <span><a href="{{route('category',$cat->url)}}">{{$cat->name}}</a></span>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title" style="max-width: 80px!important;">Description</td>

                            @foreach($products as $product)
                                <?php
                                $item = \App\Product::where('id',$product->product_id)->first();
                                ?>
                                <td class="product-description">
                                    <div class="item_{{$product->product_id}}_{{$product->attribute_id}}">
                                        <p>{!! $item->description !!}</p>
                                    </div>

                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title" style="max-width: 80px!important;">Price</td>
                            @foreach($products as $product)

                                <td class="product-description">
                                    <div class="item_{{$product->product_id}}_{{$product->attribute_id}}">
                                        ₦{{$product->price}}
                                    </div>
                                </td>
                            @endforeach
                        </tr>

                        <tr>

                            <td class="product-title" style="max-width: 80px!important;">Stock</td>
                            @foreach($products as $product)
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
                                <td class="product-description item">
                                    <div class="item_{{$product->product_id}}_{{$product->attribute_id}}">
                                        @if($stock > 0)In Stock @else Out of Stock @endif
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title" style="max-width: 80px!important;">Add to cart</td>
                            @foreach($products as $product)
                                <?php
                                $attr = $product->attribute_id;
                                ?>
                                <input type="hidden" name="price" value="{{$product->price}}" id="price{{$product->product_id}}">
                                <input type="hidden" name="product_name" value="{{$product->product_name}}" id="product_name{{$product->product_id}}">
                                <input type="hidden" name="product_code" value="{{$product->product_code}}" id="product_code{{$product->product_id}}">
                                <input type="hidden" name="product_attr" value="{{$attr}}" id="product_attr{{$product->product_id}}{{$product->attribute_id}}">
                                <td class="product-description">
                                    <div class="item_{{$product->product_id}}_{{$product->attribute_id}}">
                                        <a class="compare-cart text-uppercase" href="#" onclick="compareToCart({{$product->product_id}},{{$product->attribute_id}})"><i
                                                    class="fa fa-shopping-cart"></i>add to cart</a>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title" style="max-width: 80px!important;">Delete</td>
                            @foreach($products as $product)
                                <td class="product-description">
                                    <?php
                                    $clicked = $product->product_id.'#'.$product->attribute_id;
                                    ?>
                                    <div class="item_{{$product->product_id}}_{{$product->attribute_id}}">
                                        <a href="#" onclick="deleteCompare({{$product->id}},{{$product->product_id}},{{$product->attribute_id}})">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="product-title">Rating</td>
                            @foreach($products as $product)

                                <?php
                                $ratings = \App\Review::where('product_id',$product->product_id)->avg('rating');
                                $rating = ceil($ratings);
                                ?>
                            <td class="product-description">

                                <div class="product-rating item_{{$product->product_id}}_{{$product->attribute_id}}">
                                    <span>
                                        @if($rating == 1)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>

                                        @elseif($rating == 2)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>

                                        @elseif($rating == 3)

                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>

                                        @elseif($rating == 4)

                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>


                                        @elseif($rating == 5)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                         @else
                                            N/A
                                        @endif
                             </span>
                                </div>
                            </td>
                            @endforeach
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        @endif


    </div>

@endsection

<script>


</script>