<div class="cart-box">
    <ul>
        <!-- Search Box Start Here -->
        <li>
            <a href="#">
                <span class="pe-7s-search"></span>
            </a>
            <div class="categorie-search-box menu-dropdown">
                <form action="{{route('search')}}" method="GET">
                    <input type="text" name="product" placeholder="Search our catalog">
                    <button type="submit">
                        <span class="pe-7s-search"></span>
                    </button>
                </form>
            </div>
        </li>

        <li>
            <a href="#">
                <span class="pe-7s-shopbag"></span>
                <span class="total-pro">2</span>
            </a>
            <ul class="ht-dropdown cart-box-width">
                <li>
                    <!-- Cart Box Start -->
                    <div class="single-cart-box">
                        <div class="cart-img">
                            <a href="#">
                                <img src="img/products/p1.jpg" alt="cart-image">
                            </a>
                            <span class="pro-quantity">1X</span>
                        </div>
                        <div class="cart-content">
                            <h6>
                                <a href="cart.html">Modern Eye Brush </a>
                            </h6>
                            <span class="cart-price">27.45</span>
                            <span>Size: S</span>
                            <span>Color: Yellow</span>
                        </div>
                        <a class="del-icone" href="#">
                            <i class="ion-close"></i>
                        </a>
                    </div>
                    <!-- Cart Box End -->
                    <!-- Cart Box Start -->
                    <div class="single-cart-box">
                        <div class="cart-img">
                            <a href="#">
                                <img src="img/products/p2.jpg" alt="cart-image">
                            </a>
                            <span class="pro-quantity">1X</span>
                        </div>
                        <div class="cart-content">
                            <h6>
                                <a href="cart.html">Flat Velvet Lipstick</a>
                            </h6>
                            <span class="cart-price">45.00</span>
                            <span>Size: XL</span>
                            <span>Color: Green</span>
                        </div>
                        <a class="del-icone" href="#">
                            <i class="ion-close"></i>
                        </a>
                    </div>
                    <!-- Cart Box End -->
                    <!-- Cart Footer Inner Start -->
                    <div class="cart-footer">
                        <ul class="price-content">
                            <li>Subtotal
                                <span>$57.95</span>
                            </li>
                            <li>Shipping
                                <span>$7.00</span>
                            </li>
                            <li>Taxes
                                <span>$0.00</span>
                            </li>
                            <li>Total
                                <span>$64.95</span>
                            </li>
                        </ul>
                        <div class="cart-actions text-center">
                            <a class="cart-checkout" href="checkout.html">Checkout</a>
                        </div>
                    </div>
                    <!-- Cart Footer Inner End -->
                </li>
            </ul>
        </li>

    </ul>
</div>


<header>
    <div class="header-main stick header-sticky">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-xl-3 col-lg-2 col-6">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img src="{{asset('images/frontend/logo.png')}}" alt="logo-image">
                        </a>
                    </div>
                </div>



                <div class="col-xl-7 col-lg-8 d-none d-lg-block">
                    <nav>
                        <ul class="header-bottom-list d-flex">
                            <li class="active">
                                <a class="" href="{{route('home')}}">home</a>
                            </li>
                            <li>
                                <a class="dropdown-caret" href="#">Categories</a>

                                <ul class="menu-dropdown topmenu topmenu-three ">

                                    @foreach($categories as $category)
                                        <li>
                                            <ul>
                                                <li class="menu-tile"><a href="{{route('niche',$category->url)}}">{{strtoupper($category->name)}}</a></li>
                                                <?php

                                                $cats = \App\Category::where('parent_id',$category->id)->get();

                                                foreach($cats as $cat){
                                                ?>
                                                <li><a href="{{route('category',$cat->url)}}">{{$cat->name}}</a></li>
                                                <?php
                                                }

                                                ?>
                                            </ul>
                                        </li>
                                    @endforeach

                                </ul>

                            </li>
                            <li>
                                <a class="dropdown-caret" href="">Brands</a>

                                <style>
                                    .brand{
                                        width: 500px!important;
                                    }
                                </style>
                                <ul class="menu-dropdown topmenu brand">
                                    <li>
                                        <ul>
                                            <div class="row">

                                                @foreach($brands as $brand)
                                                    <div class="col-3">
                                                        <li>
                                                            <a href="{{route('brand',$brand->url)}}">{{ucwords($brand->name)}}</a>
                                                        </li>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </ul>
                                    </li>

                                </ul>

                            </li>
                            <li>
                                <a class="" href="{{route('products')}}">Shop</a>
                            </li>

                            <li>
                                <a class="dropdown-caret" href="#">pages</a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="menu-dropdown">
                                    <li>
                                        <a href="{{route('contact')}}">contact us</a>
                                    </li>
                                    <li>
                                        <a href="about.html">about us</a>
                                    </li>
                                </ul>
                                $image = $image = Product::where('id',$product->product_id)->first();
                                <!-- Home Version Dropdown End -->
                                <img src="'.asset('images/backend/products/small/'.$image->image).'" alt="cart-image">
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-xl-2 col-lg-2 col-6">
                    <div class="cart-box">
                        <ul>
                            <!-- Search Box Start Here -->
                            <li>
                                <a href="#">
                                    <span class="pe-7s-search"></span>
                                </a>
                                <div class="categorie-search-box menu-dropdown">
                                    <form action="{{route('search')}}" method="GET">
                                        <input type="text" name="product" placeholder="Search our catalog">
                                        <button type="submit">
                                            <span class="pe-7s-search"></span>
                                        </button>
                                    </form>
                                </div>
                            </li>

                            <li>
                                <a href="#">
                                    <span class="pe-7s-shopbag"></span>
                                    <span class="total-pro">2</span>
                                </a>
                                <ul class="ht-dropdown cart-box-width">
                                    <li>
                                        <!-- Cart Box Start -->
                                        <div class="single-cart-box">
                                            <div class="cart-img">
                                                <a href="#">
                                                    <img src="img/products/p1.jpg" alt="cart-image">
                                                </a>
                                                <span class="pro-quantity">1X</span>
                                            </div>
                                            <div class="cart-content">
                                                <h6>
                                                    <a href="cart.html">Modern Eye Brush </a>
                                                </h6>
                                                <span class="cart-price">27.45</span>
                                                <span>Size: S</span>
                                                <span>Color: Yellow</span>
                                            </div>
                                            <a class="del-icone" href="#">
                                                <i class="ion-close"></i>
                                            </a>
                                        </div>
                                        <!-- Cart Box End -->
                                        <!-- Cart Box Start -->
                                        <div class="single-cart-box">
                                            <div class="cart-img">
                                                <a href="#">
                                                    <img src="img/products/p2.jpg" alt="cart-image">
                                                </a>
                                                <span class="pro-quantity">1X</span>
                                            </div>
                                            <div class="cart-content">
                                                <h6>
                                                    <a href="cart.html">Flat Velvet Lipstick</a>
                                                </h6>
                                                <span class="cart-price">45.00</span>
                                                <span>Size: XL</span>
                                                <span>Color: Green</span>
                                            </div>
                                            <a class="del-icone" href="#">
                                                <i class="ion-close"></i>
                                            </a>
                                        </div>
                                        <!-- Cart Box End -->
                                        <!-- Cart Footer Inner Start -->
                                        <div class="cart-footer">
                                            <ul class="price-content">
                                                <li>Subtotal
                                                    <span>$57.95</span>
                                                </li>
                                                <li>Shipping
                                                    <span>$7.00</span>
                                                </li>
                                                <li>Taxes
                                                    <span>$0.00</span>
                                                </li>
                                                <li>Total
                                                    <span>$64.95</span>
                                                </li>
                                            </ul>
                                            <div class="cart-actions text-center">
                                                <a class="cart-checkout" href="checkout.html">Checkout</a>
                                            </div>
                                        </div>
                                        <!-- Cart Footer Inner End -->
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>



            <style>
                .mobile-menu nav  .brand-dropdown{
                    max-height: none!important;
                }
            </style>

            <!-- Mobile Menu Start Here -->
            <div class="mobile-menu d-block d-lg-none">
                <nav>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">home</a>
                        </li>
                        <li>
                            <a href="#">Categories</a>


                            <ul class="submobile-mega-dropdown">

                                @foreach($categories as $category)
                                    <li>
                                        <a href="#">{{$category->name}}</a>
                                        <ul>

                                            <?php

                                            $cats = \App\Category::where('parent_id',$category->id)->get();

                                            foreach($cats as $cat){
                                            ?>
                                            <li><a href="">{{$cat->name}}</a></li>
                                            <?php
                                            }

                                            ?>

                                        </ul>

                                    </li>
                                @endforeach

                            </ul>

                        </li>


                        <li>
                            <a href="#">Brands</a>
                            <ul class="brand-dropdown">
                                <li>
                                    @foreach($brands as $brand)
                                        <a href="">{{$brand->name}}</a>
                                    @endforeach
                                </li>
                            </ul>

                        </li>

                        <li>
                            <a href="#">Products</a>
                        </li>
                        <li>
                            <a href="contact.html">contact us</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Mobile Menu End Here -->
        </div>
        <!-- Container End -->
    </div>
</header>

<tr class="item">
    <td>
        Website design
    </td>

    <td>
        $300.00
    </td>
</tr>

<tr class="item">
    <td>
        Hosting (3 months)
    </td>

    <td>
        $75.00
    </td>
</tr>

<tr class="item last">
    <td>
        Domain name (1 year)
    </td>

    <td>
        $10.00
    </td>
</tr>

<tr class="total">
    <td></td>

    <td>
        Total: $385.00
    </td>
</tr>


<tr class="heading">
    <td>
        Item
    </td>

    <td>
        Price
    </td>
</tr>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">



            <td class="title" colspan="3">
                <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
            </td>


            <td colspan="2">
                <b>Order ID</b> : 123<br>
                <b>Date:</b> January 1, 2015<br>

            </td>


        </tr>


        <tr class="information" style="margin-top:30px!important;">

            <td style="margin-top:30px!important;" colspan="3">
                <strong>Alvinsmakeup</strong><br>
                Ibrahim Taiwo Road<br>Ilorin<br>Kwara State<br>Email: support@alvinsmakeup.com
            </td>




            <td colspan="2">
                Acme Corp.<br>
                John Doe<br>
                john@example.com
            </td><br>
        </tr>
        <tr class="top information">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="top information">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>


        <tr class="heading">
            <td>
                Product
            </td>

            <td>
                Code
            </td>
            <td>
                Price
            </td>

            <td>
                Quantity
            </td>

            <td>
                Subtotal
            </td>



        </tr>
        <tr class="item">
            <td>
                Website design
            </td>

            <td>600</td>


            <td>2500</td>


            <td>2</td>

            <td>
                600
            </td>
        </tr>


        <tr class="total">
            <td colspan="3"></td>

            <td>
                Total:
            </td>
            <td>
                $385.00
            </td>
        </tr>



    </table>
    <table>
        <tr>
            <td><a type="button" class="print" href="javascript:window.print();" style="float: right!important;"><i class="fa fa-print"></i> Print</a></td>
        </tr>
    </table>
</div>



