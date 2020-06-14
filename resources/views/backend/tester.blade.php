<div class="breadcrumb-area">
    <div class="container">
        <ol class="breadcrumb breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Product Details</li>
        </ol>
    </div>


    <div class="main-product-thumbnail white-bg ptb-90">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="main{{$product->id}}" class="tab-pane fade show active">
                            <a data-fancybox="images" href="">
                                <img src="{{asset('images/backend/products/medium/'.$product->image)}}" alt="product-view">
                            </a>
                        </div>

                        @if ($product->pictures->count() != 0)
                            @foreach($product->pictures as $picture)
                                <div id="thumb{{$picture->id}}" class="tab-pane fade">
                                    <a data-fancybox="images" href="">
                                        <img src="{{asset('images/backend/pictures/medium/'.$picture->image)}}" alt="product-view">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Thumbnail Large Image End -->



                    <!-- Thumbnail Image End -->
                    @if ($product->pictures->count() != 0)
                        <div class="product-thumbnail">
                            <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                <a class="active" data-toggle="tab" href="#main{{$product->id}}">
                                    <img src="{{asset('images/backend/products/small/'.$product->image)}}" alt="product-thumbnail">
                                </a>




                                @foreach($product->pictures as $picture)
                                    <a data-toggle="tab" href="#thumb{{$picture->id}}">
                                        <img src="{{asset('images/backend/pictures/small/'.$picture->image)}}" alt="product-thumbnail">
                                    </a>
                                @endforeach


                            </div>
                        </div>
                @endif

                <!-- Thumbnail image end -->
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">New Look eye Material</h3>
                        <ul class="rating-summary">
                            <li class="rating-pro">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </li>
                            <li class="read-review"><a href="#">read reviews (1)</a></li>
                            <li class="write-review"><a href="#">write review</a></li>
                        </ul>
                        <div class="pro-thumb-price mt-10">
                            <p class="d-flex align-items-center"><span class="prev-price">16.51</span><span
                                        class="price">$15.19</span><span class="saving-price">-5%</span></p>
                        </div>
                        <p class="pro-desc-details">Faded short sleeves t-shirt with high neckline. Soft and
                            stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready
                            for summer!</p>
                        <div class="product-size mtb-30 clearfix">
                            <label>Size</label>
                            <select class="">
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                            </select>
                        </div>
                        <div class="color clearfix mb-30">
                            <label>color</label>
                            <ul class="color-list">
                                <li>
                                    <a class="white" href="#"></a>
                                </li>
                                <li>
                                    <a class="orange active" href="#"></a>
                                </li>
                                <li>
                                    <a class="paste" href="#"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="quatity-stock">
                            <label>Quantity</label>
                            <ul class="d-flex flex-wrap  align-items-center">
                                <li class="box-quantity">
                                    <form action="#">
                                        <input class="quantity" type="number" min="1" value="1">
                                    </form>
                                </li>
                                <li>
                                    <button class="pro-cart">add to cart</button>
                                </li>
                                <li class="pro-ref">
                                    <p><span class="in-stock"><i class="ion-checkmark-round"></i> in stock</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="social-sharing mt-30">
                            <ul>
                                <li><label>share</label></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
