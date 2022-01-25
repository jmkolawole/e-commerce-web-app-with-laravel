<div class="col-lg-3 order-2 order-lg-1 mt-all-40">
    <form action="{{route('filter')}}" method="POST">
        {{csrf_field()}}

        @if(isset($category))
            <input type="hidden" name="url" value="products/category/{{$url}}">
        @elseif(isset($niche_protect))
            <input type="hidden" name="url" value="products/niche/{{$url}}">
        @elseif(isset($brand))
            <input type="hidden" name="url" value="products/brand/{{$url}}">
        @elseif(isset($products_protect))
            <input type="hidden" name="url" value="{{$url}}">
        @elseif(isset($makeupSpecialProtect))
            <input type="hidden" name="url" value="products/{{$url}}">
        @endif

        <style>
            #accordion {
                list-style: none;
                padding: 0 0 0 0;
                width: 170px;
            }
            #accordion div {
                display: block;
                font-weight: 500;
                margin: 3px 0px;
                cursor: pointer;
                padding: 2px 0px 2px 0px;
                list-style: circle;
                -moz-border-radius: 10px;
                -webkit-border-radius: 10px;
                border-radius: 10px;
            }
            #accordion ul {
                list-style: none;
                padding: 3px 0 3px 0;
                margin-left: 20px!important;
            }
            #accordion ul li{
                margin-top: 1px;
            }
            #accordion ul{
                display: none;
            }
            #accordion a {
                text-decoration: none;
            }
            #accordion a:hover {
                text-decoration: underline;
            }

        </style>





        <div class="sidebar shop-sidebar">

            <div class="color mb-30">
                <h3 class="sidebar-title">Categories</h3>
            <ul id="accordion">
               @foreach($categories as $category)
                   <?php
                       $count_cat = \App\Product::where('niche_id',$category->id)->get();
                     ?>
                <li class=""><div>{{ucwords($category->name)}}<span> ({{$count_cat->count()}})</span></div>
                    <ul>
                        <?php

                            ?>
                        @foreach($category->categories as $sub_cat)
                         @if($sub_cat->products->count() != 0)
                        <li><a href="{{route('category',$sub_cat->url)}}">{{$sub_cat->name}} ({{$sub_cat->products->count()}})</a></li>
                         @endif
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
            </div>


            <style>
                .color-span{
                    position: relative;
                    left:25px;
                    top: -5px;
                }

                .color-choose{
                    position: relative;
                    top: 12px;
                }
            </style>


            <script src="{{asset('js/frontend/js/vendor/jquery-3.3.1.min.js')}}"></script>
            <script>
                $("#accordion > li > div").click(function(){

                    if(false == $(this).next().is(':visible')) {
                        $('#accordion ul').slideUp(300);
                    }
                    $(this).next().slideToggle(300);
                });

            </script>

            <style>
                .brand span{

                }
                .brand{
                    list-style-type: none!important;
                    font-size: 15px!important;
                    font-weight: 400;
                    margin: 3px 0;
                }
            </style>

            <div class="color mb-30">
                <h3 class="sidebar-title">Brands</h3>
                <div style="max-height: 10em!important; overflow-y: scroll!important;">
                @foreach($brands as $brand)
                        @if($brand->products->count() != 0)
                <li class="brand">
                    <a href="{{route('brand',$brand->url)}}"><span class="">{{$brand->name}} ({{$brand->products->count()}})</span></a>

                </li>
                        @endif

                @endforeach
                </div>

            </div>

            <style>
                .price{

                    margin-top: 10px!important;
                }
                .price .price-span{
                    width:130px!important;
                    position: relative;
                    top: 4px;
                    box-shadow: none!important;
                    font-size: 14px!important;
                    font-weight: 500!important;
                }
            </style>

            <div class="color mb-30">
                <h3 class="sidebar-title">Price (₦)</h3>
                <ul class="color-option sidbar-style">

                    <?php
                    $minPrice = "";
                    if(isset($_GET['minPrice']) && isset($_GET['maxPrice'])){
                        $minPrice = $_GET['minPrice'];
                    }

                    $price = "";
                    if(isset($_GET['price'])){
                        $price = $_GET['price'];
                    }

                    ?>
                    <li class="price">
                        <input  name="priceFilter" onchange="javascript:this.form.submit();"
                                class="form-check-input" @if(isset($_GET['minPrice']) && ($minPrice == 1)) checked @endif value="1-499" type="radio">
                        <label class="form-check-label"><span class="price-span">1 - 499</span>
                        </label>
                    </li>


                    <li class="price">
                        <input  name="priceFilter" onchange="javascript:this.form.submit();"
                                class="form-check-input" @if($minPrice == 500) checked @endif value="500-999" type="radio">
                        <label class="form-check-label"><span class="price-span">500 - 999</span>
                        </label>
                    </li>

                    <li class="price">
                        <input  name="priceFilter" onchange="javascript:this.form.submit();"
                                class="form-check-input" @if($minPrice == 1000) checked @endif value="1000-2499" type="radio">
                        <label class="form-check-label"><span class="price-span">1000 - 2499</span>
                        </label>
                    </li>


                    <li class="price">
                        <input  name="priceFilter" onchange="javascript:this.form.submit();"
                                class="form-check-input" @if($minPrice == 2500) checked @endif value="2500-4999" type="radio">
                        <label class="form-check-label"><span class="price-span">2500 - 4999</span>
                        </label>
                    </li>

                    <li class="price">
                        <input  name="priceFilter" onchange="javascript:this.form.submit();"
                                class="form-check-input" @if($minPrice == 5000) checked @endif value="5000-9999" type="radio">
                        <label class="form-check-label"><span class="price-span">5000 - 9999</span>
                        </label>
                    </li>

                    <li class="price">
                            <input  name="priceFilter" onchange="javascript:this.form.submit();"
                                class="form-check-input" @if($minPrice == 10000) checked @endif value="10000-50000" type="radio">
                        <label class="form-check-label"><span class="price-span">10000 - 49,999</span>
                        </label>
                    </li>

                    <li class="price">
                        <input  name="priceFilter" onchange="javascript:this.form.submit();"
                                class="form-check-input" @if($price) checked @endif value="50000upwards" type="radio">
                        <label class="form-check-label"><span class="price-span">50000 Upwards</span>
                        </label>
                    </li>


                </ul>
            </div>

        </div>
        <!-- Single Banner Start -->
    </form>

</div>