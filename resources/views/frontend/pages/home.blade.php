@extends('frontend.layouts.master')
@section('title', 'Alvins Makeup Nigeria: Buy Makeup And Cosmetics.')
@section('description', 'Shop For And Buy Now From Our Extensive Range Of Makeup, Cosmetics, Skincare And
Beauty Products In Nigeria. Alvins Makeup Is Located In Ilorin, Nigeria.')
@section('keywords', 'Alvins Makeup Nigeria: Buy Makeup, Cosmetics And Skincare')
@section('og_title','Alvins Makeup Nigeria: Buy Makeup And Cosmetics')
@section('og_url',url('/'))
@section('og_description','Shop For And Buy Now From Our Collection Of Makeup Products')
<?php
$image = \App\Product::latest()->first();
?>
@section('og_image',asset('images/backend/products/small/'.$image->image))



@section('content')
    <div class="slider-div">
        <div class="slider-activate owl-carousel">
            <div class="slide align-center-left fullscreen animation-style-01 bg-image-1" style="background-image: url({{asset('images/backend/banners/'.$banners->slider1)}})">
                <div class="slider-progress"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider-content">
                                <h1>{{$banners->topic1}}</h1>
                                <p>{{$banners->body1}}</p>
                                <div class="slide-btn small-btn">
                                    <a href="{{route('products')}}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="slide align-center-left fullscreen animation-style-02" style="background-image: url({{asset('images/backend/banners/'.$banners->slider2)}})">
                <div class="slider-progress"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider-content">
                                <h1>{{$banners->topic2}}</h1>
                                <p>{{$banners->body2}}</p><div class="slide-btn small-btn">
                                    <a href="">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="slide align-center-left fullscreen animation-style-02" style="background-image: url({{asset('images/backend/banners/'.$banners->slider3)}})">
                <div class="slider-progress"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider-content">
                                <h1>{{$banners->topic3}}</h1>
                                <p>{{$banners->body3}}</p>
                                <div class="slide-btn small-btn">
                                    <a href="">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="banner-area pt-20 pb-90">
        <div class="container">
            <div class="row">
                <!--  Single Banner Area Start -->
                <div class="col-lg-4 col-md-4 mb-sm-30">
                    <div class="single-banner zoom">
                        <a href="{{route('products')}}">
                            <img src="{{asset('images/backend/banners/'.$banners->banner1)}}" alt="banner-img">
                        </a>
                    </div>
                </div>
                <!--  Single Banner Area End -->
                <!--  Single Banner Area Start -->
                <div class="col-lg-4 col-md-4 mb-sm-30">
                    <div class="single-banner zoom">
                        <a href="{{route('products')}}">
                            <img src="{{asset('images/backend/banners/'.$banners->banner2)}}" alt="banner-img">
                        </a>
                    </div>
                </div>
                <!--  Single Banner Area End -->
                <!--  Single Banner Area Start -->
                <div class="col-lg-4 col-md-4">
                    <div class="single-banner zoom">
                        <a href="{{route('products')}}">
                            <img src="{{asset('images/backend/banners/'.$banners->banner3)}}" alt="banner-img">
                        </a>
                    </div>
                </div>
                <!--  Single Banner Area End -->
            </div>
        </div>
    </div>


    <div class="new-arrival no-border-style ptb-90">
        <div class="container">

            <div class="section-title text-center">
                <h2>new arrivals</h2>
                <p>Add our new arrivals to your weekly lineup</p>
            </div>



            <div class="@if($new_arrivals->count() >= 4) pro-active-loop @else our-pro-active @endif owl-carousel">
                <?php $mode_id = 0; ?>
                <?php $mode_ids = []; ?>
                @foreach($new_arrivals as $new_arrival)
                    <?php $mode_id = $new_arrival->id?>
                    <?php $mode_ids[] = $new_arrival->id ?>
                    <div class="dual-pro">
                        <div class="single-makal-product">
                            <div class="pro-img">
                                <a href="{{route('product',$new_arrival->url)}}">
                                    <img src="{{asset('images/backend/products/medium/'.$new_arrival->image)}}" alt="product-img">
                                </a>

                                @if($new_arrival->created_at >= date("Y-m-d H:i:s",strtotime('-8 weeks',time())))
                                    <span class="sticker-new">new</span>
                                @endif
                                <div class="quick-view-pro">
                                    <a data-toggle="modal" data-target="#{{$mode_id}}" class="quick-view modal-view"
                                       href="#{{$mode_id}}" rel="{{$new_arrival->id}}"></a>
                                </div>
                            </div>
                            <div class="pro-content">
                                <h4 class="pro-title">
                                    <a href="{{route('product',$new_arrival->url)}}">{{$new_arrival->product_name}}</a>
                                </h4>
                                <p>
                                    <span class="price">₦{{$new_arrival->price}}</span>
                                    @if($new_arrival->prev_price != 0)<span class="prev-price">₦{{$new_arrival->prev_price}}</span>@endif
                                </p>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="@if($new_arrivals2->count() >= 4) pro-active-loop @else our-pro-active @endif owl-carousel">
                <?php $modal2_id = 0; ?>
                <?php $modal2_ids = []; ?>
                @foreach($new_arrivals2 as $new_arrival2)
                    <?php $modal2_id = $new_arrival2->id?>
                    <?php $modal2_ids[] = $new_arrival2->id ?>
                    <div class="dual-pro">
                        <div class="single-makal-product">
                            <div class="pro-img">
                                <a href="{{route('product',$new_arrival2->url)}}">
                                    <img src="{{asset('images/backend/products/medium/'.$new_arrival2->image)}}" alt="product-img">
                                </a>

                                @if($new_arrival2->created_at >= date("Y-m-d H:i:s",strtotime('-8 weeks',time())))
                                    <span class="sticker-new">new</span>
                                @endif
                                <div class="quick-view-pro">
                                    <a data-toggle="modal" data-target="#{{$modal2_id}}" class="quick-view modal-view"
                                       href="#{{$modal2_id}}" rel="{{$new_arrival2->id}}"></a>
                                </div>
                            </div>
                            <div class="pro-content">
                                <h4 class="pro-title">
                                    <a href="{{route('product',$new_arrival2->url)}}">{{$new_arrival2->product_name}}</a>
                                </h4>
                                <p>
                                    <span class="price">₦{{$new_arrival2->price}}</span>
                                    @if($new_arrival2->prev_price != 0)<span class="prev-price">₦{{$new_arrival2->prev_price}}</span>@endif
                                </p>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>




        </div>
    </div>




    <div class="categories-slider pt-90">
        <div class="container">

            <div class="row">
                @foreach($groups as $group)
                    <div class="col-xl-3 col-lg-3 mb-all-40">
                        <div class="featured-inner-pro">
                            <div class="pro-inner-title">
                                <h3>{{$group->name}}</h3>
                            </div>

                            <div class="categorie-slider-active owl-carousel">

                                <div class="tripple-pro">


                                    <?php

                                    $products = \App\Product::where('niche_id',$group->id)->orderBy('id','desc')->take(2)->get();
                                    foreach($products as $product){
                                    ?>
                                    <div class="single-makali-product">
                                        <div class="pro-img">
                                            <a href="{{route('product',$product->id)}}"><img src="{{asset('images/backend/products/small/'.$product->image)}}" alt="product-img"></a>
                                        </div>
                                        <div class="pro-content">
                                            <h4 class="pro-title"><a href="{{route('product',$product->url)}}">{{ucwords($product->product_name)}}</a>
                                            </h4>

                                            <p><span class="price">₦{{$product->price}}</span>
                                                @if($product->prev_price != 0)<span class="prev-price">₦{{$product->prev_price}}</span>@endif

                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>


                                <div class="tripple-pro">


                                    <?php

                                    $products = \App\Product::where('niche_id',$group->id)->orderBy('id','desc')->skip(2)->take(2)->get();
                                    foreach($products as $product){

                                    ?>

                                    <div class="single-makali-product">
                                        <div class="pro-img">
                                            <a href="{{route('product',$product->url)}}"><img src="{{asset('images/backend/products/small/'.$product->image)}}" alt="product-img"></a>
                                        </div>
                                        <div class="pro-content">
                                            <h4 class="pro-title"><a href="{{route('product',$product->url)}}">{{ucwords($product->product_name)}}</a>
                                            </h4>
                                            <p><span class="price">₦{{$product->price}}</span>
                                                @if($product->prev_price != 0)<span class="prev-price">₦{{$product->prev_price}}</span>@endif
                                        </div>
                                    </div>

                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="our-product popular-products ptb-90">
        <div class="container">

            <div class="section-title text-center">
                <h2>Our Special Products</h2>
                <p>Add These Exciting Products To Your Weekly Products</p>
            </div>

            <div class="main-product-tab-area">
                <!-- Nav tabs -->
                <ul class="nav tabs-area pro-tabs-area" role="tablist">
                    <li class="nav-item">
                        <a class="active" data-toggle="tab" href="#special">Alvins makeup special</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#sale">Best Sellers</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#popular">Popular Products</a>
                    </li>
                </ul>





                <div class="tab-content">
                    <div id="special" class="tab-pane fade show active">

                        <div class="our-pro-active owl-carousel">

                            <?php $modal3_id = 0; ?>
                            <?php $modal3_ids = []; ?>
                            @foreach($specials as $special)

                                <?php $modal3_id = $special->id?>
                                <?php $modal3_ids[] = $special->id ?>
                                <div class="single-makal-product">
                                    <div class="pro-img">
                                        <a href="{{route('product',$special->url)}}">
                                            <img src="{{asset('images/backend/products/medium/'.$special->image)}}" alt="product-img">
                                        </a>
                                        @if($special->created_at >= date("Y-m-d H:i:s",strtotime('-8 weeks',time())))
                                            <span class="sticker-new">new</span>
                                        @endif
                                        <div class="quick-view-pro">
                                            <a data-toggle="modal" data-target="#{{$modal3_id}}" class="quick-view"
                                               href="#{{$modal3_id}}"></a>
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <h4 class="pro-title">
                                            <a href="{{route('product',$special->url)}}">{{$special->product_name}}</a>
                                        </h4>
                                        <p>
                                        <p><span class="price">₦{{$special->price}}</span>
                                            @if($special->prev_price != 0)<span class="prev-price">₦{{$special->prev_price}}</span>@endif
                                        </p>

                                    </div>
                                </div>


                            @endforeach
                        </div>

                    </div>

                    <div id="sale" class="tab-pane fade">
                        <div class="our-pro-active owl-carousel">

                            <?php $modal3_id = 0; ?>
                            <?php $modal3_ids = []; ?>
                                @foreach($bestSellers as $id)
                                    <?php
                                    $product = \App\Product::where('id',$id->product_id)->first();
                                    ?>
                                    @if($product)
                                    <?php $modal3_id = $id->product_id?>
                                    <?php $modal3_ids[] = $id->product_id ?>

                                    <div class="single-makal-product">
                                        <div class="pro-img">
                                            <a href="{{route('product',$product->url)}}">
                                                <img src="{{asset('images/backend/products/medium/'.$product->image)}}" alt="product-img">
                                            </a>
                                            @if($product->created_at >= date("Y-m-d H:i:s",strtotime('-8 weeks',time())))
                                                <span class="sticker-new">new</span>
                                            @endif
                                            <div class="quick-view-pro">
                                                <a data-toggle="modal" data-target="#{{$modal3_id}}" class="quick-view"
                                                   href="#{{$modal3_id}}"></a>
                                            </div>
                                        </div>
                                        <div class="pro-content">
                                            <h4 class="pro-title">
                                                <a href="{{route('product',$product->url)}}">{{$product->product_name}}</a>
                                            </h4>
                                            <p>
                                            <p><span class="price">₦{{$product->price}}</span>
                                                @if($product->prev_price != 0)<span class="prev-price">₦{{$product->prev_price}}</span>@endif
                                            </p>

                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                        </div>
                    </div>

                    <div id="popular" class="tab-pane fade">
                        <div class="our-pro-active owl-carousel">

                            <?php $modal_id = 0; ?>
                            <?php $modal_ids = []; ?>
                            @foreach($populars as $popular)
                                <?php $modal_id = $popular->id?>
                                <?php $modal_ids[] = $popular->id ?>
                                <div class="single-makal-product">
                                    <div class="pro-img">
                                        <a href="{{route('product',$popular->url)}}">
                                            <img src="{{asset('images/backend/products/medium/'.$popular->image)}}" alt="product-img">
                                        </a>
                                        @if($popular->created_at >= date("Y-m-d H:i:s",strtotime('-8 weeks',time())))
                                            <span class="sticker-new">new</span>
                                        @endif
                                        <div class="quick-view-pro">
                                            <a data-toggle="modal" data-target="#{{$modal_id}}" class="quick-view"
                                               href="#{{$modal_id}}"></a>
                                        </div>
                                    </div>
                                    <div class="pro-content">
                                        <h4 class="pro-title">
                                            <a href="{{route('product',$popular->url)}}">{{$popular->product_name}}</a>
                                        </h4>
                                        <p>
                                        <p><span class="price">₦{{$popular->price}}</span>
                                            @if($popular->prev_price != 0)<span class="prev-price">₦{{$popular->prev_price}}</span>@endif
                                        </p>

                                    </div>
                                </div>


                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>




    <div class="testmonial ptb-90" style="background-image: url({{asset('images/frontend/t1.jpg')}})">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title text-center cl-testmonial">
                <h2>Client Testimonials</h2>
                <p>what they say</p>
            </div>
            <!-- Section Title End -->
            <div class="testmonial-active owl-carousel">

                @foreach($testimonies as $testimony)
                    <div class="single-testmonial text-center">
                        <div class="testmonial-content">
                            <p>{{$testimony->body}}</p>
                            <span class="t-author">{{$testimony->name}}</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    @foreach($mode_ids as $item)
        <div class="main-product-thumbnail quick-thumb-content">
            <div class="container">
                <!-- The Modal -->
                <?php
                $product = \App\Product::where('id',$item)->first();
                ?>
                <div class="modal fade" id="{{$item}}">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->

                            <div class="modal-body">
                                <div class="row">
                                    <!-- Main Thumbnail Image Start -->
                                    <div class="col-lg-5 col-md-6 mb-all-40">
                                        <!-- Thumbnail Large Image start -->
                                        <div class="tab-content">
                                            <div id="pro-1" class="tab-pane fade show active">
                                                <a data-fancybox="images" href="">
                                                    <img src="{{asset('images/backend/products/medium/'.$product->image)}}" alt="product-view">
                                                </a>
                                            </div>
                                            <?php
                                            $pictures = \App\Picture::where('product_id',$product->id)->get();
                                            ?>
                                            @foreach($pictures as $picture)
                                                <div id="pro-{{$picture->id}}" class="tab-pane fade">
                                                    <a data-fancybox="images" href="">
                                                        <img src="{{asset('images/backend/pictures/medium/'.$picture->image)}}" alt="product-view">
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="product-thumbnail">
                                            <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                                <a class="active" data-toggle="tab" href="#pro-1">
                                                    <img src="{{asset('images/backend/products/small/'.$product->image)}}" alt="product-thumbnail">
                                                </a>

                                                @foreach($pictures as $picture)
                                                    <a data-toggle="tab" href="#pro-{{$picture->id}}">
                                                        <img src="{{asset('images/backend/pictures/small/'.$picture->image)}}" alt="product-thumbnail">
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <!-- Thumbnail image end -->
                                    </div>
                                    <!-- Main Thumbnail Image End -->
                                    <!-- Thumbnail Description Start -->
                                    <div class="col-lg-7 col-md-6">
                                        <div class="thubnail-desc fix">
                                            <h3 class="product-header">{{$product->product_name}}</h3>
                                            <ul class="rating-summary">
                                                @if(Auth::guard('visitor')->check())
                                                    <li class=""><a href="#" onclick="addToCompare({{$product->id}})"><i class="fa fa-plus fa-xs"></i> Add To Compare</a></li>
                                                    <li class=""><a href="#" onclick="addToWishlist({{$product->id}})"><i class="fa fa-plus fa-xs"></i> Add To Wishlist</a></li>
                                                @endif

                                                <span>
                                            <?php
                                                    $rating = $product->reviews->where('approve',1)->where('product_id',$product->id)->avg('rating');
                                                    $rating = ceil($rating);
                                                    ?>
                                                    @if($rating == 1)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>

                                                    @elseif($rating == 2)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                                    @elseif($rating == 3)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                                    @elseif($rating == 4)

                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>

                                                    @elseif($rating == 5)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                                    @endif
                             </span>


                                                <li class="read-review"><a href="#">({{$product->reviews->where('approve',1)->count()}})</a></li>
                                            </ul>
                                            <div class="pro-thumb-price mt-10">
                                                <p class="d-flex align-items-center"><span class="prev-price">
                                                        @if($product->prev_price != 0)₦{{$product->prev_price}}@endif</span><span

                                                            class="price" style="position: relative!important;">₦{{$product->price}}</span>
                                                </p>
                                            </div>

                                            @if($product->description != "")
                                                <hr>
                                                <p class="pro-desc-detail">{!! $product->description !!}</p>
                                                <hr>
                                            @endif

                                            <div class="product-size mtb-30 clearfix">
                                                <label><b>Brand:</b> <a href="{{route('brand',$product->brand->url)}}">{{$product->brand->name}}</a></label>
                                            </div>

                                            <div class="product-size mtb-30 clearfix">
                                                <?php
                                                $niche =  \App\Category::where('id',$product->category->parent_id)->first();
                                                ?>
                                                <label><b>Niche:</b> <a href="{{route('niche',$niche->url)}}">{{$niche->name}}</a></label>
                                            </div>

                                            <div class="product-size mtb-30 clearfix">
                                                <label><b>Category:</b> <a href="{{route('category',$product->category->url)}}">{{$product->category->name}}</a></label>
                                            </div>


                                            <div class="color clearfix mb-30">
                                                @if($product->attributes->where('picker','<>','')->count() > 0)
                                                    <label>Shades</label>
                                                    <ul class="color-list">
                                                        @foreach($product->attributes as $item)

                                                            <li>
                                                                <a class="javascript:void(0)" title="{{$item->color}}" style="background-color: {{$item->picker}}!important;" href="#"></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>

                                            <div class="product-size mtb-30 clearfix @if($product->stock_status == "no") product-size-attr @endif">
                                                <select name="type" id="type-select{{$product->id}}"  style="min-width:150px!important;" class="form-control" onchange="getProductType({{$product->id}});">
                                                    <option value="0#none#0">
                                                        @if($product->attributes->where('picker','<>','')->count() > 0)
                                                            Select Shade
                                                        @else
                                                            Select Type
                                                        @endif
                                                    </option>
                                                    @foreach($product->attributes as $item)
                                                        <option value="{{$product->id}}#{{$item->color}}#{{$item->id}}">{{$item->color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="quatity-stock">
                                                <label>Quantity</label>

                                                <ul class="d-flex flex-wrap  align-items-center">

                                                    <li class="box-quantity">
                                                        <input class="quantity" type="number" id="quantity{{$product->id}}" name="quantity" min="1" value="1">
                                                        <input type="hidden" name="pro_id" value="{{$product->id}}" id="pro_id{{$product->id}}">
                                                        <input type="hidden" name="price" value="{{$product->price}}" id="price{{$product->id}}">
                                                        <input type="hidden" name="product_name" value="{{$product->product_name}}" id="product_name{{$product->id}}">
                                                        <input type="hidden" name="product_code" value="{{$product->product_code}}" id="product_code{{$product->id}}">

                                                    </li>

                                                    <li id="add-to-cart{{$product->id}}">
                                                        @if($product->stock_status == "no" && $product->stock > 0)
                                                            <button class="pro-cart" id="product-cart{{$product->id}}" onclick="addToCart({{$product->id}})">add to cart</button>
                                                        @endif
                                                    </li>


                                                    <li class="pro-ref">
                                                        @if($product->stock_status == "no" && $product->stock > 0)
                                                            <p id=""><span class="in-stock"><i class="ion-checkmark-round"></i> In Stock</span></p>
                                                        @elseif($product->stock_status == "no" && $product->stock == 0)
                                                            <p id="" style="color: red!important;"><span class="in-stock"><i class="ion-checkmark-round"></i> Out Of Stock</span></p>
                                                        @endif

                                                        <p id="in-stock{{$product->id}}" style="display: none"><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span>
                                                        </p>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="social-sharing mt-30">
                                                <ul>
                                                    <li><label>share</label></li>
                                                    <li><a href="https://www.facebook.com/sharer.php?u={{url('product/'.$product->url)}}" target="_blank" rel="noopener">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="http://www.twitter.com/share?url={{url('product/'.$product->url)}}&text={{truncate(strip_tags($product->description), 50)}}"
                                                           target="_blank" rel="noopener"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                    </li>
                                                    <li><a href="whatsapp://?text={{url('product/'.$product->url)}}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Description End -->
                                </div>
                            </div>
                            <!-- Modal footer -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($modal2_ids as $item)
        <div class="main-product-thumbnail quick-thumb-content">
            <div class="container">
                <!-- The Modal -->
                <?php
                $product = \App\Product::where('id',$item)->first();
                ?>
                <div class="modal fade" id="{{$item}}">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->

                            <div class="modal-body">
                                <div class="row">
                                    <!-- Main Thumbnail Image Start -->
                                    <div class="col-lg-5 col-md-6 mb-all-40">
                                        <!-- Thumbnail Large Image start -->
                                        <div class="tab-content">
                                            <div id="pro-1" class="tab-pane fade show active">
                                                <a data-fancybox="images" href="">
                                                    <img src="{{asset('images/backend/products/medium/'.$product->image)}}" alt="product-view">
                                                </a>
                                            </div>
                                            <?php
                                            $pictures = \App\Picture::where('product_id',$product->id)->get();
                                            ?>
                                            @foreach($pictures as $picture)
                                                <div id="pro-{{$picture->id}}" class="tab-pane fade">
                                                    <a data-fancybox="images" href="">
                                                        <img src="{{asset('images/backend/pictures/medium/'.$picture->image)}}" alt="product-view">
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="product-thumbnail">
                                            <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                                <a class="active" data-toggle="tab" href="#pro-1">
                                                    <img src="{{asset('images/backend/products/small/'.$product->image)}}" alt="product-thumbnail">
                                                </a>

                                                @foreach($pictures as $picture)
                                                    <a data-toggle="tab" href="#pro-{{$picture->id}}">
                                                        <img src="{{asset('images/backend/pictures/small/'.$picture->image)}}" alt="product-thumbnail">
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <!-- Thumbnail image end -->
                                    </div>
                                    <!-- Main Thumbnail Image End -->
                                    <!-- Thumbnail Description Start -->
                                    <div class="col-lg-7 col-md-6">
                                        <div class="thubnail-desc fix">
                                            <h3 class="product-header">{{$product->product_name}}</h3>
                                            <ul class="rating-summary">
                                                @if(Auth::guard('visitor')->check())
                                                    <li class=""><a href="#" onclick="addToCompare({{$product->id}})"><i class="fa fa-plus fa-xs"></i> Add To Compare</a></li>
                                                    <li class=""><a href="#" onclick="addToWishlist({{$product->id}})"><i class="fa fa-plus fa-xs"></i> Add To Wishlist</a></li>
                                                @endif

                                                <span>
                                            <?php
                                                    $rating = $product->reviews->where('approve',1)->where('product_id',$product->id)->avg('rating');
                                                    $rating = ceil($rating);
                                                    ?>
                                                    @if($rating == 1)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>

                                                    @elseif($rating == 2)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                                    @elseif($rating == 3)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                                    @elseif($rating == 4)

                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>

                                                    @elseif($rating == 5)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                                    @endif
                             </span>


                                                <li class="read-review"><a href="#">({{$product->reviews->where('approve',1)->count()}})</a></li>
                                            </ul>
                                            <div class="pro-thumb-price mt-10">
                                                <p class="d-flex align-items-center"><span class="prev-price">
                                                        @if($product->prev_price != 0)₦{{$product->prev_price}}@endif</span><span

                                                            class="price" style="position: relative!important;">₦{{$product->price}}</span>
                                                </p>
                                            </div>

                                            @if($product->description != "")
                                                <hr>
                                                <p class="pro-desc-detail">{!! $product->description !!}</p>
                                                <hr>
                                            @endif

                                            <div class="product-size mtb-30 clearfix">
                                                <label><b>Brand:</b> <a href="{{route('brand',$product->brand->url)}}">{{$product->brand->name}}</a></label>
                                            </div>

                                            <div class="product-size mtb-30 clearfix">
                                                <?php
                                                $niche =  \App\Category::where('id',$product->category->parent_id)->first();
                                                ?>
                                                <label><b>Niche:</b> <a href="{{route('niche',$niche->url)}}">{{$niche->name}}</a></label>
                                            </div>

                                            <div class="product-size mtb-30 clearfix">
                                                <label><b>Category:</b> <a href="{{route('category',$product->category->url)}}">{{$product->category->name}}</a></label>
                                            </div>


                                            <div class="color clearfix mb-30">
                                                @if($product->attributes->where('picker','<>','')->count() > 0)
                                                    <label>Shades</label>
                                                    <ul class="color-list">
                                                        @foreach($product->attributes as $item)

                                                            <li>
                                                                <a class="javascript:void(0)" title="{{$item->color}}" style="background-color: {{$item->picker}}!important;" href="#"></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>

                                            <div class="product-size mtb-30 clearfix @if($product->stock_status == "no") product-size-attr @endif">
                                                <select name="type" id="type-select{{$product->id}}"  style="min-width:150px!important;" class="form-control" onchange="getProductType({{$product->id}});">
                                                    <option value="0#none#0">
                                                        @if($product->attributes->where('picker','<>','')->count() > 0)
                                                            Select Shade
                                                        @else
                                                            Select Type
                                                        @endif
                                                    </option>
                                                    @foreach($product->attributes as $item)
                                                        <option value="{{$product->id}}#{{$item->color}}#{{$item->id}}">{{$item->color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="quatity-stock">
                                                <label>Quantity</label>

                                                <ul class="d-flex flex-wrap  align-items-center">

                                                    <li class="box-quantity">
                                                        <input class="quantity" type="number" id="quantity{{$product->id}}" name="quantity" min="1" value="1">
                                                        <input type="hidden" name="pro_id" value="{{$product->id}}" id="pro_id{{$product->id}}">
                                                        <input type="hidden" name="price" value="{{$product->price}}" id="price{{$product->id}}">
                                                        <input type="hidden" name="product_name" value="{{$product->product_name}}" id="product_name{{$product->id}}">
                                                        <input type="hidden" name="product_code" value="{{$product->product_code}}" id="product_code{{$product->id}}">

                                                    </li>

                                                    <li id="add-to-cart{{$product->id}}">
                                                        @if($product->stock_status == "no" && $product->stock > 0)
                                                            <button class="pro-cart" id="product-cart{{$product->id}}" onclick="addToCart({{$product->id}})">add to cart</button>
                                                        @endif
                                                    </li>


                                                    <li class="pro-ref">
                                                        @if($product->stock_status == "no" && $product->stock > 0)
                                                            <p id=""><span class="in-stock"><i class="ion-checkmark-round"></i> In Stock</span></p>
                                                        @elseif($product->stock_status == "no" && $product->stock == 0)
                                                            <p id="" style="color: red!important;"><span class="in-stock"><i class="ion-checkmark-round"></i> Out Of Stock</span></p>
                                                        @endif

                                                        <p id="in-stock{{$product->id}}" style="display: none"><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span>
                                                        </p>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="social-sharing mt-30">
                                                <ul>
                                                    <li><label>share</label></li>
                                                    <li><a href="https://www.facebook.com/sharer.php?u={{url('product/'.$product->url)}}" target="_blank" rel="noopener">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="http://www.twitter.com/share?url={{url('product/'.$product->url)}}&text={{truncate(strip_tags($product->description), 50)}}"
                                                           target="_blank" rel="noopener"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                    </li>
                                                    <li><a href="whatsapp://?text={{url('product/'.$product->url)}}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Description End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach


    @foreach($modal3_ids as $item)
        <div class="main-product-thumbnail quick-thumb-content">
            <div class="container">
                <!-- The Modal -->
                <?php
                $product = \App\Product::where('id',$item)->first();
                ?>
                <div class="modal fade" id="{{$item}}">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->

                            <div class="modal-body">
                                <div class="row">
                                    <!-- Main Thumbnail Image Start -->
                                    <div class="col-lg-5 col-md-6 mb-all-40">
                                        <!-- Thumbnail Large Image start -->
                                        <div class="tab-content">
                                            <div id="pro-1" class="tab-pane fade show active">
                                                <a data-fancybox="images" href="">
                                                    <img src="{{asset('images/backend/products/medium/'.$product->image)}}" alt="product-view">
                                                </a>
                                            </div>
                                            <?php
                                            $pictures = \App\Picture::where('product_id',$product->id)->get();
                                            ?>
                                            @foreach($pictures as $picture)
                                                <div id="pro-{{$picture->id}}" class="tab-pane fade">
                                                    <a data-fancybox="images" href="">
                                                        <img src="{{asset('images/backend/pictures/medium/'.$picture->image)}}" alt="product-view">
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="product-thumbnail">
                                            <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                                <a class="active" data-toggle="tab" href="#pro-1">
                                                    <img src="{{asset('images/backend/products/small/'.$product->image)}}" alt="product-thumbnail">
                                                </a>

                                                @foreach($pictures as $picture)
                                                    <a data-toggle="tab" href="#pro-{{$picture->id}}">
                                                        <img src="{{asset('images/backend/pictures/small/'.$picture->image)}}" alt="product-thumbnail">
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <!-- Thumbnail image end -->
                                    </div>
                                    <!-- Main Thumbnail Image End -->
                                    <!-- Thumbnail Description Start -->
                                    <div class="col-lg-7 col-md-6">
                                        <div class="thubnail-desc fix">
                                            <h3 class="product-header">{{$product->product_name}}</h3>
                                            <ul class="rating-summary">
                                                @if(Auth::guard('visitor')->check())
                                                    <li class=""><a href="#" onclick="addToCompare({{$product->id}})"><i class="fa fa-plus fa-xs"></i> Add To Compare</a></li>
                                                    <li class=""><a href="#" onclick="addToWishlist({{$product->id}})"><i class="fa fa-plus fa-xs"></i> Add To Wishlist</a></li>
                                                @endif

                                                <span>
                                            <?php
                                                    $rating = $product->reviews->where('approve',1)->where('product_id',$product->id)->avg('rating');
                                                    $rating = ceil($rating);
                                                    ?>
                                                    @if($rating == 1)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>

                                                    @elseif($rating == 2)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                                    @elseif($rating == 3)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                                    @elseif($rating == 4)

                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>

                                                    @elseif($rating == 5)
                                                        <li class="rating-pro">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                                    @endif
                             </span>


                                                <li class="read-review"><a href="#">({{$product->reviews->where('approve',1)->count()}})</a></li>
                                            </ul>
                                            <div class="pro-thumb-price mt-10">
                                                <p class="d-flex align-items-center"><span class="prev-price">
                                                        @if($product->prev_price != 0)₦{{$product->prev_price}}@endif</span><span

                                                            class="price" style="position: relative!important;">₦{{$product->price}}</span>
                                                </p>
                                            </div>

                                            @if($product->description != "")
                                                <hr>
                                                <p class="pro-desc-detail">{!! $product->description !!}</p>
                                                <hr>
                                            @endif

                                            <div class="product-size mtb-30 clearfix">
                                                <label><b>Brand:</b> <a href="{{route('brand',$product->brand->url)}}">{{$product->brand->name}}</a></label>
                                            </div>

                                            <div class="product-size mtb-30 clearfix">
                                                <?php
                                                $niche =  \App\Category::where('id',$product->category->parent_id)->first();
                                                ?>
                                                <label><b>Niche:</b> <a href="{{route('niche',$niche->url)}}">{{$niche->name}}</a></label>
                                            </div>

                                            <div class="product-size mtb-30 clearfix">
                                                <label><b>Category:</b> <a href="{{route('category',$product->category->url)}}">{{$product->category->name}}</a></label>
                                            </div>


                                            <div class="color clearfix mb-30">
                                                @if($product->attributes->where('picker','<>','')->count() > 0)
                                                    <label>Shades</label>
                                                    <ul class="color-list">
                                                        @foreach($product->attributes as $item)

                                                            <li>
                                                                <a class="javascript:void(0)" title="{{$item->color}}" style="background-color: {{$item->picker}}!important;" href="#"></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>

                                            <div class="product-size mtb-30 clearfix @if($product->stock_status == "no") product-size-attr @endif">
                                                <select name="type" id="type-select{{$product->id}}"  style="min-width:150px!important;" class="form-control" onchange="getProductType({{$product->id}});">
                                                    <option value="0#none#0">
                                                        @if($product->attributes->where('picker','<>','')->count() > 0)
                                                            Select Shade
                                                        @else
                                                            Select Type
                                                        @endif
                                                    </option>
                                                    @foreach($product->attributes as $item)
                                                        <option value="{{$product->id}}#{{$item->color}}#{{$item->id}}">{{$item->color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="quatity-stock">
                                                <label>Quantity</label>

                                                <ul class="d-flex flex-wrap  align-items-center">

                                                    <li class="box-quantity">
                                                        <input class="quantity" type="number" id="quantity{{$product->id}}" name="quantity" min="1" value="1">
                                                        <input type="hidden" name="pro_id" value="{{$product->id}}" id="pro_id{{$product->id}}">
                                                        <input type="hidden" name="price" value="{{$product->price}}" id="price{{$product->id}}">
                                                        <input type="hidden" name="product_name" value="{{$product->product_name}}" id="product_name{{$product->id}}">
                                                        <input type="hidden" name="product_code" value="{{$product->product_code}}" id="product_code{{$product->id}}">

                                                    </li>

                                                    <li id="add-to-cart{{$product->id}}">
                                                        @if($product->stock_status == "no" && $product->stock > 0)
                                                            <button class="pro-cart" id="product-cart{{$product->id}}" onclick="addToCart({{$product->id}})">add to cart</button>
                                                        @endif
                                                    </li>


                                                    <li class="pro-ref">
                                                        @if($product->stock_status == "no" && $product->stock > 0)
                                                            <p id=""><span class="in-stock"><i class="ion-checkmark-round"></i> In Stock</span></p>
                                                        @elseif($product->stock_status == "no" && $product->stock == 0)
                                                            <p id="" style="color: red!important;"><span class="in-stock"><i class="ion-checkmark-round"></i> Out Of Stock</span></p>
                                                        @endif

                                                        <p id="in-stock{{$product->id}}" style="display: none"><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span>
                                                        </p>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="social-sharing mt-30">
                                                <ul>
                                                    <li><label>share</label></li>
                                                    <li><a href="https://www.facebook.com/sharer.php?u={{url('product/'.$product->url)}}" target="_blank" rel="noopener">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="http://www.twitter.com/share?url={{url('product/'.$product->url)}}&text={{truncate(strip_tags($product->description), 50)}}"
                                                           target="_blank" rel="noopener"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                    </li>
                                                    <li><a href="whatsapp://?text={{url('product/'.$product->url)}}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Description End -->
                                </div>
                            </div>
                            <!-- Modal footer -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach









@endsection


