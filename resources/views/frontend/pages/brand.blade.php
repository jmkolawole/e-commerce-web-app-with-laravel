@extends('frontend.layouts.master')
@section('title',$brand->name .' | Brand | Alvins Makeup')
@if($brand->description != "")
    @section('description', truncate($brand->description, 150))
@endif
@if($brand->keywords != "")
    @section('keywords', truncate($brand->keywords, 150))
@endif

@section('og_title',$brand->name .' | Brand | Alvins Makeup')
@section('og_url',url('/brand/'.$brand->url))
@section('og_description',truncate($brand->description, 60))
<?php
$image = \App\Product::where('brand_id',$brand->id)->latest()->first();
?>
@section('og_image',asset('images/backend/products/small/'.$image->image))

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb breadcrumb-list">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">{{$brand->name}}</li>
            </ol>
        </div>
    </div>

    <div class="main-shop-page ptb-90">
        <div class="container">
            <!-- Row End -->
            <div class="row">


                @include('frontend.widgets.sidebar')

                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- Grid & List View Start -->
                    <div
                            class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
                        <div class="grid-list-view d-flex align-items-center  mb-sm-15">
                            <ul class="nav tabs-area d-flex align-items-center">
                                <li><a class="active" data-toggle="tab" href="#grid-view"><i
                                                class="fa fa-th"></i></a></li>
                                <li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                            </ul>
                            <span class="show-items">There are {{$products->total()}} products in this category.</span>
                        </div>

                    </div>

                    <!-- Grid & List View End -->
                    <div class="shop-area mb-all-40">
                        <!-- Grid & List Main Area End -->
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade show active">
                                <div class="row border-hover-effect ">
                                    <?php $modal_id = 0; ?>
                                    <?php $modal_ids = []; ?>
                                    @foreach($products as $product)
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                            <?php $modal_id = $product->id?>
                                            <?php $modal_ids[] = $product->id ?>
                                            <div class="single-makal-product">
                                                <div class="pro-img">
                                                    <a href="{{route('product',$product->url)}}">
                                                        <img src="{{asset('images/backend/products/medium/'.$product->image)}}" alt="product-img">
                                                    </a>
                                                    @if($product->created_at >= date("Y-m-d H:i:s",strtotime('-8 weeks',time())))
                                                        <span class="sticker-new">new</span>
                                                    @endif
                                                    <div class="quick-view-pro">
                                                        <a data-toggle="modal" data-target="#{{$modal_id}}"
                                                           class="quick-view" href="#{{$modal_id}}"></a>
                                                    </div>
                                                </div>
                                                <div class="pro-content">
                                                    <h4 class="pro-title">
                                                        <a href="{{route('product',$product->url)}}">{{$product->product_name}}</a>
                                                    </h4>
                                                    <p>
                                                        <span class="price">₦{{$product->price}}</span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Row End -->
                            </div>
                            <!-- #grid view End -->
                            <div id="list-view" class="tab-pane fade fix boxes">

                                @foreach($products as $product)
                                    <div class="single-makal-product" data-price = "{{$product}}">
                                        <div class="pro-img">
                                            <a href="{{route('product',$product->url)}}">
                                                <img src="{{asset('images/backend/products/medium/'.$product->image)}}" alt="product-img">
                                            </a>
                                            <span class="sticker-new">new</span>
                                        </div>
                                        <div class="pro-content">
                                            <h4 class="pro-title"><a href="{{route('product',$product->url)}}">{{$product->product_name}}</a>
                                            </h4>
                                            <p><span class="price">₦{{$product->price}}</span><span class="prev-price">
                                                    @if($product->prev_price != 0)₦{{$product->prev_price}}@endif</span>
                                            </p>

                                            <style>
                                                .pro-content p + p{
                                                    border-top: none!important;
                                                    margin-top:1px !important;
                                                    padding-top:1px!important;
                                                }
                                            </style>

                                            <hr style="width:100%!important;">
                                            <p style="border-top: none!important;">{!! $product->description !!}</p>
                                            <hr>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- #list view End -->
                        </div>
                        <!-- Grid & List Main Area End -->
                    </div>

                    <div class="shop-breadcrumb-area border-default mt-30">
                        <div class="row">


                            <div class="col-lg-4 col-md-4 col-sm-5">
                                <span class="show-items">Showing {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}} item(s) </span>
                            </div>

                            {{$products->appends(request()->except('page'))->links()}}
                        </div>
                    </div>


                    <!-- Shop Breadcrumb Area Start -->

                    <!-- Shop Breadcrumb Area End -->
                </div>

            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>

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

