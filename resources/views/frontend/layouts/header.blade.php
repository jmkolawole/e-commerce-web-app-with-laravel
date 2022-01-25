<header>


    <div class="header-top">
        <div class="container">
            <div class="col-sm-12">
                <div class="row justify-content-lg-between justify-content-center">
                    <!-- Header Top Left Start -->
                    <div class="header-top-left order-2 order-lg-1">
                        <ul>
                            <li>
                                <a href="tel:+2348027871372"><i class="fa fa-phone"></i> +2348027871372</a>
                            </li>
                            <li>
                                <a href="mailto:support@alvinsmakeup.com"><i class="fa fa-envelope-open-o"></i> support@alvinsmakeup.com</a>
                            </li>
                            <li>
                                <ul class="social-icon">
                                    <li>
                                        <a href="https://www.facebook.com/alvinsmakeup">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/alvinsmakeup">
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/AlvinsMakeup">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Header Top Left End -->
                    <!-- Header Top Right Start -->
                    <div class="header-top-right order-1 order-lg-2">
                        <ul>
                            <li>
                                <a href="#">Settings
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <!-- Dropdown Start -->
                                <ul class="ht-dropdown">

                                    @if(!\Illuminate\Support\Facades\Auth::guard('visitor')->check())
                                        <li>
                                            <a href="{{route('register.user')}}">Register</a>
                                        </li>
                                    @endif

                                    @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check())
                                        <li>
                                            <a href="{{route('user.account')}}">My Account</a>
                                        </li>
                                    @endif

                                    @if(\Illuminate\Support\Facades\Auth::guard('visitor')->check())
                                        <li>
                                            <a href="{{route('logout.user')}}">Logout</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{route('login.user')}}">Login</a>
                                        </li>

                                    @endif


                                </ul>
                                <!-- Dropdown End -->
                            </li>
                        </ul>
                    </div>
                    <!-- Header Top Right End -->
                </div>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <div class="header-middle stick header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo Start -->
                <div class="col-xl-3 col-lg-2 col-6">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img src="{{asset('images/frontend/logo1.png')}}" alt="logo-image">
                        </a>
                    </div>
                </div>



                <div class="col-xl-7 col-lg-8 d-none d-lg-block">
                    <nav>
                        <ul class="header-bottom-list d-flex">
                            <li>
                                <a href="{{route('home')}}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'home') class="active-header" @endif>home</a>
                            </li>
                            <li>
                                <a class="drop-icon" @if(\Illuminate\Support\Facades\Route::currentRouteName() == "category"
                                || \Illuminate\Support\Facades\Route::currentRouteName() == "niche")
                                style="color: firebrick!important;font-weight:bold!important;font-size: 95%!important;" @endif>Categories</a>
                                <!--  Mega-Menu Start -->


                                <ul class="ht-dropdown megamenu megamenu-three ">



                                    @foreach($categories as $category)
                                        <li>
                                            <ul>
                                                <?php
                                                if (\Illuminate\Support\Facades\Route::currentRouteName() == "category"){
                                                    $item = request()->segment(3);
                                                    $value = \App\Category::where('url',$item)->first();

                                                }
                                                ?>
                                                <li class="menu-tile">
                                                    @if($category->status == 1)
                                                    <a href="{{route('niche',$category->url)}}" @if((request()->segment(2) == "niche" && request()->segment(3) == $category->url)
                                                || \Illuminate\Support\Facades\Route::currentRouteName() == "category" && $category->id == $value->parent_id) class="active-header" @endif>
                                                        <b>{{strtoupper($category->name)}}</b>
                                                    </a>
                                                    @endif
                                                </li>
                                                <?php
                                                $cats = \App\Category::where('parent_id',$category->id)->get();


                                                foreach($cats as $cat){
                                                ?>
                                                @if($cat->products->count() != 0)
                                                    <li><a href="{{route('category',$cat->url)}}" @if(request()->segment(3) == $cat->url)
                                                    style="color: firebrick!important;font-weight:bold!important;font-size:90%!important;" @endif>{{$cat->name}}</a></li>
                                                @endif
                                                <?php
                                                }

                                                ?>

                                            </ul>
                                        </li>
                                    @endforeach

                                </ul>
                                <!-- Mega-Menu End -->
                            </li>

                            <?php


                            ?>

                            <li>
                                <a class="drop-icon @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'brand') active-header @endif" href="#">Brands</a>
                                <style>
                                    .brand{
                                        width: 500px!important;
                                    }
                                </style>

                                <ul class="ht-dropdown brand">
                                    <li>
                                        <ul>
                                            <div class="row">

                                                @foreach($brands as $brand)
                                                    <div class="col-3">
                                                        @if($brand->products->count() != 0)
                                                        <li>
                                                            <a href="{{route('brand',$brand->url)}}"  class="<?php
                                                            if(request()->segment(2) == "brand" && request()->segment(3) == $brand->url){
                                                                echo 'active-header';
                                                            }
                                                            ?>">{{ucwords($brand->name)}}</a>
                                                        </li>
                                                         @endif
                                                    </div>
                                                @endforeach

                                            </div>
                                        </ul>
                                    </li>
                                </ul>

                            </li>



                            <li>
                                <a @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'products') class="active-header" @endif href="{{route('products')}}" >Shop</a>
                            </li>


                            <li>
                                <a class="drop-icon @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'contact' ||
                                \Illuminate\Support\Facades\Route::currentRouteName() == 'about' || \Illuminate\Support\Facades\Route::currentRouteName() == 'compare'
                                || \Illuminate\Support\Facades\Route::currentRouteName() == 'wishlist')
                                        active-header" @endif href="#" >pages</a>

                                <ul class="ht-dropdown">
                                    @if(Auth::guard('visitor')->check())
                                    <li>
                                        <a href="{{route('wishlist')}}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'wishlist') class="active-header" @endif>Wishlist</a>
                                    </li>


                                    <li>
                                        <a href="{{route('compare')}}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'compare') class="active-header" @endif>Compare</a>
                                    </li>
                                    @endif

                                    <li>
                                        <a href="{{route('contact')}}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'contact') class="active-header" @endif>contact us</a>
                                    </li>
                                    <li>
                                        <a href="{{route('about')}}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'about') class="active-header" @endif>about us</a>
                                    </li>



                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Menu Area End Here -->
                <!-- Cart Box Start Here -->
                <div class="col-xl-2 col-lg-2 col-6">
                    <div class="cart-box">
                        <ul>
                            <!-- Search Box Start Here -->
                            <li>
                                <a href="#">
                                    <span class="pe-7s-search"></span>
                                </a>
                                <div class="categorie-search-box ht-dropdown">
                                    <form action="{{route('search')}}" method="GET">
                                        <input type="text" name="product" placeholder="Search our catalog">
                                        <button>
                                            <span class="pe-7s-search"></span>
                                        </button>
                                    </form>
                                </div>
                            </li>


                            <!-- Categorie Search Box End Here -->
                            <li id="shopping-cart">
                                <a href="#">
                                    <span class="pe-7s-shopbag"></span>
                                    <span class="total-pro">{{$cart_count}}</span>
                                </a>
                                <ul class="ht-dropdown cart-box-width">
                                    @if($cart_count > 0)
                                        <li><div style="max-height:300px!important;overflow-y: scroll!important;">

                                                <?php
                                                $total_amount = 0;
                                                ?>
                                                @foreach($cart_products as $product)
                                                    <?php

                                                    $image = \App\Product::where('id',$product->product_id)->first();
                                                    if($image){
                                                    ?>
                                                    <div class="single-cart-box">
                                                        <div class="cart-img">
                                                            <a href="{{route('product',$image->url)}}">
                                                                <img src="{{asset('images/backend/products/small/'.$image->image)}}" alt="cart-image">
                                                            </a>
                                                            <span class="pro-quantity">{{$product->quantity}}X</span>
                                                        </div>
                                                        <div class="cart-content">
                                                            <h6>
                                                                <a href="{{route('product',$image->url)}}">{{$product->product_name}}</a>
                                                            </h6>
                                                            <span class="cart-price">₦{{$product->price}}</span>
                                                            @if($product->attribute_id != 0)
                                                                <?php
                                                                $name = \App\Attribute::where('id',$product->attribute_id)->first();
                                                                ?>
                                                                @if($name)
                                                                <span>({{$name->color}})</span>
                                                                 @endif
                                                            @endif
                                                        </div>
                                                        <a class="del-icone" href="#">
                                                            <i class="ion-close"></i>
                                                        </a>
                                                    </div>

                                                    <?php
                                                        }else{
                                                        \Illuminate\Support\Facades\DB::table('carts')->where('product_id',$product->product_id)->delete();
                                                        }
                                                    $total_amount = $total_amount + ($product->price * $product->quantity);
                                                    ?>
                                                @endforeach

                                            </div>

                                            <div class="cart-footer">
                                                <ul class="price-content">
                                                    <li>Total
                                                        <span>₦{{$total_amount}}</span>
                                                    </li>
                                                </ul>
                                                <div class="cart-actions text-center">
                                                    <a class="cart-checkout" href="{{route('cart')}}">Open Cart</a>
                                                </div>
                                            </div>

                                        </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Cart Box End Here -->
            </div>
            <!-- Row End -->
            <!-- Mobile Menu Start Here -->
            <div class="mobile-menu d-block d-lg-none">
                <nav>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li>
                            <a href="#">Categories</a>
                            <!-- Men Accessories Dropdown Start -->
                            <ul class="submobile-mega-dropdown">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{route('niche',$category->url)}}">{{$category->name}}</a>
                                    <!-- Watches Dropdown Start -->
                                    <ul>
                                    <?php
                                                $cats = \App\Category::where('parent_id',$category->id)->get();

                                    ?>
                                     @foreach($cats as $cat)
                                            @if($cat->products->count() != 0)
                                        <li>
                                            <a href="{{route('category',$cat->url)}}">{{$cat->name}}</a>
                                        </li>
                                            @endif
                                     @endforeach


                                    </ul>
                                    <!-- Watches Dropdown End -->
                                </li>
                                @endforeach
                            </ul>
                            <!-- Men Accessories Dropdown End -->
                        </li>


                        <li>
                            <a href="">Brands</a>

                            <ul>
                                @foreach($brands as $brand)
                                @if($brand->products->count() != 0)
                                    <li>
                                    <a href="{{route('brand',$brand->url)}}">{{$brand->name}}</a>
                                    </li>
                                 @endif
                                @endforeach
                            </ul>
                            <!-- Mobile Menu Dropdown End -->
                        </li>

                        <li>
                            <a href="{{route('products')}}">Shop</a>
                        </li>

                        <li>
                            <a href="#">pages</a>
                            <!-- Mobile Menu Dropdown Start -->
                            <ul>

                                @if(Auth::guard('visitor')->check())
                                <li>  <a href="{{route('wishlist')}}">Wishlist</a>

                                </li>

                                <li>
                                        <a href="{{route('compare')}}">Compare</a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{route('contact')}}">Contact Us</a>
                                </li>
                                <li>
                                    <a href="{{route('about')}}">About Us</a>
                                </li>

                            </ul>
                            <!-- Mobile Menu Dropdown End -->
                        </li>

                    </ul>
                </nav>
            </div>
            <!-- Mobile Menu End Here -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Middle End Here -->
</header>
