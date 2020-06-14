@extends('frontend.layouts.master')
@section('title', $product->product_name .' | '. $product->category->name. ' | Alvins Makeup')

@if($product->description != "")
    @section('description', truncate(strip_tags($product->description), 150))
@else
    @section('description', "Buy Authentic ". $product->product_name .' From Alvins Makeup. Order Products From Your Popular Brands Such as Revlon, Milani, Tara, Mary Kay')
@endif

@if($product->keywords != "")
    @section('keywords', truncate(strip_tags($product->keywords), 100))
@else
    @section('keywords', "")
@endif

@section('og_title',$product->product_name .' | '. $product->category->name. ' | Alvins Makeup')
@section('og_url',url('/product/'.$product->url))
@section('og_description',truncate(strip_tags($product->description), 60))

@section('og_image',asset('images/backend/products/small/'.$product->image))



@section('content')
    <?php
    $name = $product->product_name;
    $id = $product->id;
    ?>
    <div class="main-product-thumbnail white-bg ptb-90">
        <div class="container">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-4 col-md-6 mb-all-40">
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

                </div>




                <div class="col-lg-8 col-md-6">
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
                                <?php
                                if(Auth::guard('visitor')->check()) {
                                $user_id = Auth::guard('visitor')->user()->id;

                                ?>

                                <li class="write-review"><a href="#review" data-toggle="modal" class="quick-view" data-target="#review">write review</a></li>
                                <?php

                                }
                                ?>
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

            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>



    <div class="thumnail-desc">
        <div class="container">
            <div class="thumb-desc-inner">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="main-thumb-desc nav tabs-area" role="tablist">
                            <li><a class="active" data-toggle="tab" href="#description">Description</a></li>
                            <li><a data-toggle="tab" href="#rating">Reviews ({{$rating_count}})</a></li>
                            @if($product->video != '')<li><a data-toggle="tab" href="#vid">Video</a></li>@endif
                        </ul>
                        <!-- Product Thumbnail Tab Content Start -->
                        <div class="tab-content thumb-content">
                            <div id="description" class="tab-pane fade show active">
                                <p>{!! $product->description !!}</p>
                            </div>
                            <div id="rating" class="tab-pane fade">
                                <!-- Reviews Start -->
                                <div class="review">
                                   @if($ratings->count() > 0)
                                    <div class="group-title">
                                        <h2>customers reviews</h2>
                                    </div>
                                    @else
                                        <div class="group-title">
                                            <h2>No Review(s)</h2>
                                        </div>
                                    @endif
                                    <?php $mode_id = 0; ?>
                                    <?php $mode_ids = []; ?>
                                    @foreach($ratings as $value)
                                        <?php $mode_id = $value->id;?>
                                        <?php $mode_ids[] = $value->id;?>
                                        <?php

                                        $user_id = 0;
                                        if(Auth::guard('visitor')->check()) {
                                            $user_id = Auth::guard('visitor')->user()->id;


                                        }
                                        $username = \App\Visitor::where('id',$value->user_id)->first();
                                        ?>

                                        <h5 class="review-mini-title">{{$username->first_name}}</h5>
                                        @if($user_id == $value->user_id)
                                            <span><a href="#edit{{$mode_id}}" data-toggle="modal"
                                                     class="quick-view" data-target="#edit{{$mode_id}}">Edit</a></span>
                                        @endif
                                        <?php



                                        ?>

                                        <ul class="review-list">
                                            @if($value->rating == 1)
                                                <li>
                                                    <span>Rating</span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                            @elseif($value->rating == 2)
                                                <li>
                                                    <span>Rating</span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </li>

                                            @elseif($value->rating == 3)
                                                <li>
                                                    <span>Rating</span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </li>

                                            @elseif($value->rating == 4)
                                                <li>
                                                    <span>Rating</span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </li>


                                            @elseif($value->rating == 5)
                                                <li>
                                                    <span>Rating</span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i
                                                </li>
                                            @endif
                                        </ul>
                                        <p>{{$value->body}}</p>
                                    @endforeach
                                </div>
                                <!-- Reviews End -->
                            </div>


                            @if($product->video != '')
                                <div id="vid" class="tab-pane fade">

                                    <div class="vid">
                                        <div class="group-title">
                                            <h2>Product Video</h2>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <video width="320" height="240" controls>
                                                <source src="{{url('videos/'.$product->video)}}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>

                    </div>
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Container End -->
    </div>

    <div class="new-arrival no-border-style ptb-90">
        <div class="container">
        @if($relatedProducts->count() > 0)
            <!-- Section Title Start -->
            <div class="section-title text-center">
                <h2>Related Products</h2>
                <p>Add our new arrivals to your weekly lineup</p>
            </div>
            <!-- Section Title End -->
            <div class="@if($relatedProducts->count() >= 4) pro-active-loop @else our-pro-active @endif owl-carousel">
            <?php $modal_id = 0; ?>
            <?php $modal_ids = []; ?>
            @foreach($relatedProducts as $item)
                <!-- Single Product Start Here -->
                    <?php $modal_id = $item->id?>
                    <?php $modal_ids[] = $item->id ?>
                    <div class="single-makal-product">
                        <div class="pro-ime">
                            <a href="{{route('product',$item->url)}}">
                                <img src="{{asset('images/backend/products/medium/'.$item->image)}}" alt="product-img">
                            </a>

                            <div class="quick-view-pro">
                                <a data-toggle="modal" data-target="#{{$modal_id}}"
                                   class="quick-view" href="#{{$modal_id}}"></a>
                            </div>
                        </div>
                        <div class="pro-content">
                            <h4 class="pro-title">
                                <a href="{{route('product',$item->url)}}">{{$item->product_name}}</a>
                            </h4>
                            <p>
                                <span class="price">₦{{$item->price}}</span>
                            </p>

                        </div>
                    </div>
                    <!-- Single Product End Here -->
                @endforeach


            </div>
        @endif
        </div>
    </div>

    @if($relatedProducts->count() > 0)
    @foreach($modal_ids as $item)
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
                                            <hr>
                                            <p class="pro-desc-detail">{!! $product->description !!}</p>
                                            <hr>

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
                                                @if($product->attributes->count() > 0)
                                                    <label>Swatches</label>
                                                    <ul class="color-list">
                                                        @foreach($product->attributes as $item)
                                                            <li>
                                                                <a class="javascript:void(0)" title="{{$item->color}}" style="background-color: {{$item->picker}}!important;" href="#"></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>

                                            <div class="product-size mtb-30 clearfix">
                                                <select name="type" id="type-select{{$product->id}}"  style="min-width:150px!important;" class="form-control" onchange="getProductType({{$product->id}});">
                                                    <option value="0#none#0">Select Swatch</option>
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
                                                        @if($product->stock != "")
                                                            <button class="pro-cart" id="product-cart{{$product->id}}" onclick="addToCart({{$product->id}})">add to cart</button>
                                                        @endif
                                                    </li>


                                                    <li class="pro-ref">
                                                        @if($product->stock != "")
                                                            <p id=""><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span></p>
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
    @endif




    <div class="main-product-thumbnail quick-thumb-content">
        <div class="container">
            <div class="modal fade" id="review">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5>Customer Review On "{{$name}}"</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="rivie-field mt-40">

                                        <form autocomplete="off" action="{{route('add.review',$id)}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label class="req" for="subject">Title of review<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="subject" name="title"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label class="req" for="subject">Rating<span style="color: red">*</span></label>
                                                <select class="form-control" name="rating">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option selected ="selected" value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="req" for="comments">Your Review</label>
                                                <textarea class="form-control" name="body" rows="5" id="comments"
                                                          required="required"></textarea>
                                            </div>
                                            <button type="submit" class="customer-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach($mode_ids as $item)
        <div class="main-product-thumbnail quick-thumb-content">
            <div class="container">
                <div class="modal fade" id="edit{{$item}}">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Edit Your Review On "{{$name}}"</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="rivie-field mt-40">

                                            <?php
                                            $review = \App\Review::where('id',$item)->where('product_id',$id)->first();
                                            ?>
                                            <form autocomplete="off" action="{{route('edit.review',[$id, $item])}}" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label class="req" for="subject">Title of review<span style="color: red">*</span></label>
                                                    <input type="text" class="form-control" value="{{$review->title}}" id="subject" name="title"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label class="req" for="subject">Rating<span style="color: red">*</span></label>
                                                    <select class="form-control" name="rating">
                                                        <option value="1" @if($review->rating == 1)selected @endif>1</option>
                                                        <option value="2" @if($review->rating == 2)selected @endif>2</option>
                                                        <option value="3" @if($review->rating == 3)selected @endif>3</option>
                                                        <option value="4" @if($review->rating == 4)selected @endif>4</option>
                                                        <option value="5" @if($review->rating == 5)selected @endif>5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="req" for="comments">Your Review</label>
                                                    <textarea class="form-control" name="body" rows="5" id="comments"
                                                              required="required">{{$review->body}}</textarea>
                                                </div>
                                                <button type="submit" class="customer-btn">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection



