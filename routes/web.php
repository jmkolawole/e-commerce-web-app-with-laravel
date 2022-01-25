<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'web'], function () {


    //General web pages

    Route::get('/', ['uses' => 'PagesController@home', 'as' => 'home']);
    Route::get('/products', ['uses' => 'PagesController@listing', 'as' => 'listing']);
    Route::get('/about', ['uses' => 'PagesController@about', 'as' => 'about']);
    Route::match(['get', 'post'], '/contact', 'PagesController@contact')->name('contact');
    //Front Pages

    Route::get('product/{slug}', ['uses' => 'PagesController@product', 'as' => 'product']);


    //Products
    Route::get('products', ['uses' => 'PagesController@products', 'as' => 'products']);

    Route::get('tester', ['uses' => 'PagesController@tester', 'as' => 'tester']);


    //search
    Route::get('/search-product','PagesController@search')->name('search');

    //Categories
    Route::get('products/category/{url}', ['uses' => 'PagesController@category', 'as' => 'category']);

    //niche
    Route::get('products/niche/{url}', ['uses' => 'PagesController@niche', 'as' => 'niche']);


    //Chart
    Route::get('bar-chart', ['uses' => 'ChartController@index', 'as' => 'chart']);

    Route::get('stock/chart','ChartController@chart');

    //brand
    Route::get('products/brand/{url}', ['uses' => 'PagesController@brand', 'as' => 'brand']);

    //makeupSpecial
    Route::get('products/makeupSpecial', ['uses' => 'PagesController@makeupSpecial', 'as' => 'makeup.special']);


    //filter
    Route::match(['get', 'post'], '/products/filter', 'PagesController@filter')->name('filter');

    //Subscribers
    Route::post('/check-subscriber-email', ['uses' => 'PagesController@checkSubscriberEmail','as' => 'check.subscriber.email']);

    Route::post('/add-subscriber-email', ['uses' => 'PagesController@addSubscriberEmail','as' => 'add.subscriber.email']);

    Route::get('verify-subscriber/{email}/{token}', 'PagesController@verifySubscriber')->name('verify.subscriber');


    //Get Stock
    Route::get('/get-product-type','PagesController@getProductType');

    //Carts
    Route::get('cart/addItem/{id}', 'PagesController@addToCart')->name('add.cart');
    Route::get('cart', 'PagesController@cart')->name('cart');
    Route::post('fetch-cart', 'PagesController@fetchCart')->name('fetch.cart');
    Route::post('/cart/update-quantity',['uses' => 'PagesController@updateCartQuantity', 'as' => 'update.cart']);
    Route::post('/cart/remove-item',['uses' => 'PagesController@removeCartItem', 'as' => 'remove.cart']);


    //Wishlist
    Route::get('wishlist/addItem/{id}', 'PagesController@addToWishlist')->name('add.wishlist');
    Route::get('/wishlist', 'PagesController@wishlist')->name('wishlist');
    Route::get('/wishToCart/{id}', 'PagesController@wishToCart')->name('wish.to.cart');
    Route::get('/deleteWish/{id}', 'PagesController@deleteWish')->name('delete.wish');


    //Compare
    Route::get('compare/addItem/{id}', 'PagesController@addToCompare')->name('add.compare');
    Route::get('/compare', 'PagesController@compare')->name('compare');
    Route::get('/compareToCart/{id}', 'PagesController@compareToCart')->name('compare.to.cart');
    Route::get('/deleteCompare/{id}', 'PagesController@deleteCompare')->name('delete.compare');

    //Review
    Route::post('/product/{id}/review', 'PagesController@addReview')->name('add.review');
    Route::post('/product/{id}/review/edit/{item}', 'PagesController@editReview')->name('edit.review');

    //CheckOut
    Route::match(['get', 'post'], 'checkout', 'PagesController@checkout')->name('checkout');


    //Order-Review
    Route::match(['get','post'],'/order-review','PagesController@orderReview')->name('order.review');


    Route::post('/order/apply-coupon','PagesController@applyCoupon')->name('apply.coupon');

    Route::get('/order/forget-coupon','PagesController@forgetCoupon')->name('forget.coupon');

    //Process Order

    Route::get('process-order', 'PagesController@processOrder')->name('process.order');

    //Thank You
    Route::get('thank-you', 'PagesController@thankYou')->name('thank.you');



    Route::get('terms-and-conditions', 'PagesController@privacy')->name('privacy');


    //Sitemaps
    Route::get('/sitemap.xml', 'SitemapController@index');
    Route::get('/sitemap.xml/products', 'SitemapController@products');
    Route::get('/sitemap.xml/categories', 'SitemapController@categories');
    Route::get('/sitemap.xml/brands', 'SitemapController@brands');



    //Front Page Authenticaton
    Route::match(['get','post'],'register','VisitorController@register')->name('register.user');
    Route::get('login','VisitorController@showLoginForm')->name('login.user');
    Route::post('login','VisitorController@login')->name('post.login.user');
    Route::get('logout','VisitorController@getLogout')->name('logout.user');

    Route::get('verify-user/{email}/{token}','VisitorController@verifyUser')->name('verify.visitor');



    Route::match(['get','post'],'forgot-password','VisitorController@forgotPassword')->name('forgot.password');

    Route::match(['get','post'],'user-account','VisitorController@account')->name('user.account');

    Route::get('view-order/{id}', 'VisitorController@viewOrder')->name('view.visitor.order');

    Route::get('password/reset/{token}', 'VisitorController@passwordResetForm')->name('password.reset.form');


    Route::post('password/reset', 'VisitorController@reset')->name('password.reset');

    Route::post('change-password', 'VisitorController@changePassword')->name('password.change');









    Route::group(['middleware' => 'guest'], function () {
        //You must be logged out to access this
        Route::match(['get', 'post'], '/admin-login', 'AuthController@signIn')->name('login.page');
        Route::post('admin/password/email', 'Auth\ForgotPasswordController@ResetLinkEmail')->name('link.request');
        Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@passwordResetForm')->name('show.reset');
        Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset')->name('reset.password');

        //Route::match(['get', 'post'], 'admin/password/reset/{token}', 'Auth\ResetPasswordController@reset')->name('reset.password');



    });

    Route::group(['middleware' => 'auth'], function () {
        //You must be logged in to access these pages
        Route::get('/admin/dashboard', ['uses' => 'AdminController@dashboard', 'as' => 'dashboard']);


        Route::group(['middleware' => 'roles', 'roles' => 'Admin'], function () {
            //Only logged in admins can access these pages
            Route::get('/admin/users', ['uses' => 'AdminController@showUsers', 'as' => 'show.users']);
            Route::match(['get', 'post'], '/admin/user/add', 'AdminController@registerUser')->name('add.user');
            Route::post('/admin/user/assign', ['uses' => 'AdminController@assignUser', 'as' => 'assign.user']);
            Route::post('/admin/user/edit-user', ['uses' => 'AdminController@editUser', 'as' => 'edit.user']);
            Route::delete('/admin/user/delete/{id}', ['uses' => 'AdminController@destroy', 'as' => 'delete.user']);




            //Categories
            Route::POST('admin/add-category','CategoryController@addCategory')->name('add.category');
            Route::POST('admin/edit-category/{id}','CategoryController@editCategory')->name('edit.category');
            Route::get('admin/delete-category/{id}','CategoryController@deleteCategory')->name('delete.category');

            Route::get('admin/category-products/{url}','CategoryController@showProducts')->name('show.category.products');


            //Coupon Admin
            Route::match(['get','post'],'/admin/add-coupon','CouponController@addCoupon')->name('add.coupon');
            Route::get('/admin/view-coupons',['uses' => 'CouponController@viewCoupons', 'as' => 'view.coupons']);
            Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponController@editCoupon')->name('edit.coupon');
            Route::get('/admin/delete-coupon/{id}',['uses' => 'CouponController@deleteCoupon', 'as' => 'delete.coupon']);


            //Brands
            Route::POST('admin/add-brand','BrandController@addBrand')->name('add.brand');
            Route::POST('admin/edit-brand/{id}','BrandController@editBrand')->name('edit.brand');
            Route::get('admin/delete-brand/{id}','BrandController@deleteBrand')->name('delete.brand');

            Route::get('admin/brand-products/{url}','BrandController@showProducts')->name('show.brand.products');


            //Subscribers
            Route::get('admin/subscribers','AdminController@subscribers')->name('subscribers');
            Route::get('admin/delete-subscriber/{id}','AdminController@deleteSubscriber')->name('delete.subscriber');
            Route::get('admin/deactivate-subscriber/{id}','AdminController@deactivateSubscriber')->name('deactivate.subscriber');
            Route::get('admin/activate-subscriber/{id}','AdminController@activateSubscriber')->name('activate.subscriber');



            //Export Email
            Route::get('admin/export-subscribers-email','SubscriberController@exportSubscriberEmail')->name('export.email');


            //Export Products
            Route::get('admin/export-products-list','ProductController@exportProductsList')->name('export.products');


            //Export Orders
            Route::get('admin/export-orders-list','OrderController@exportOrdersList')->name('export.orders');

            //Newsletter
            Route::POST('admin/send-newsletter','ProductController@sendNewsletter')->name('send.newsletter');


            //Team Members
            Route::match(['get', 'post'], 'admin/team/add-team', 'TeamController@create')->name('team.add');
            Route::match(['get', 'post'], 'admin/team/edit-team/{id}', 'TeamController@edit')->name('team.edit');
            Route::get('/admin/team', ['uses' => 'TeamController@index','as' => 'team.index']);
            Route::get('/admin/team/{id}', ['uses' => 'TeamController@show','as' => 'team.show']);
            Route::get('/admin/team/delete-member/{id}', ['uses' => 'TeamController@delete','as' => 'team.delete']);


            Route::get('/admin/delete-testimony/{id}', ['uses' => 'TestimonyController@delete','as' => 'delete.testimony']);


            //Orders
            Route::get('/admin/view-orders',['uses' => 'OrderController@viewOrders', 'as' => 'view.orders']);

            Route::get('/admin/view-order/{id}',['uses' => 'OrderController@viewOrder', 'as' => 'view.order']);

            Route::get('/admin/order/view-invoice/{id}',['uses' => 'OrderController@viewOrderInvoice', 'as' => 'view.invoice']);

            Route::post('/admin/update-order-status',['uses' => 'OrderController@orderStatus', 'as' => 'order.status']);

            Route::get('/admin/delete-order/{id}',['uses' => 'OrderController@deleteOrder', 'as' => 'delete.order']);


            //Reviews
            Route::get('/admin/view-reviews/{id}',['uses' => 'AdminController@showReviews', 'as' => 'show.reviews']);
            Route::post('/admin/edit-review/{id}',['uses' => 'AdminController@editReview', 'as' => 'admin.edit.review']);
            Route::get('/admin/delete-review/{id}',['uses' => 'AdminController@deleteReview', 'as' => 'delete.review']);


            //Banners
            Route::match(['get', 'post'], '/admin/banners', 'BannerController@addBanner')->name('banners');

        });


        Route::group(['middleware' => 'roles', 'roles' => ['Admin', 'Author']], function () {
            //only logged in admin and authors can access this page.
            Route::get('admin/categories', ['uses' => 'CategoryController@index','as' => 'categories']);
            Route::get('admin/brands', ['uses' => 'BrandController@index','as' => 'brands']);

            //Products
            Route::match(['get','post'],'/admin/add-product','ProductController@addProduct')->name('add.product');
            Route::get('/admin/view-products',['uses' => 'ProductController@viewProducts', 'as' => 'view.products']);
            Route::match(['get','post'],'/admin/edit-product/{id}','ProductController@editProduct')->name('edit.product');
            Route::get('/admin/delete-product/{id}',['uses' => 'ProductController@deleteProduct', 'as' => 'delete.product']);
            //Delete multiple products

            Route::post('/admin/delete-products',['uses' => 'ProductController@deleteProducts', 'as' => 'delete.products']);


            //Alternate Pictures
            Route::match(['get', 'post'], 'admin/product/{id}/add-images', 'ProductController@addImages')->name('add.images');
            Route::get('/admin/delete-image/{id}',['uses' => 'ProductController@deleteImage', 'as' => 'delete.image']);


            //Color Attributes
            Route::match(['get', 'post'], 'admin/product/{id}/add-attributes', 'ProductController@addAttributes')->name('add.attributes');

            Route::match(['get', 'post'], 'admin/product/{id}/edit-attributes', 'ProductController@editAttributes')->name('edit.attributes');

            Route::get('/admin/delete-attribute/{id}',['uses' => 'ProductController@deleteAttribute', 'as' => 'delete.attribute']);


            //Testimonies
            Route::match(['get', 'post'], 'admin/add-testimony', 'TestimonyController@create')->name('add.testimony');
            Route::match(['get', 'post'], 'admin/edit-testimony/{id}', 'TestimonyController@edit')->name('edit.testimony');
            Route::get('/admin/testimonies', ['uses' => 'TestimonyController@index','as' => 'index.testimony']);
            Route::get('/admin/testimony/{id}', ['uses' => 'TestimonyController@show','as' => 'show.testimony']);



        });


        //Logged in users
        Route::match(['get', 'post'], '/admin/edit-profile', 'AdminController@editProfile')->name('edit.profile');
        Route::get('/admin/show-profile', ['uses' => 'AdminController@showProfile', 'as' => 'show.profile']);
        Route::match(['get', 'post'], '/admin/change-password', 'AdminController@editPassword')->name('edit.password');
        Route::get('/admin/logout', ['uses' => 'AuthController@getLogout', 'as' => 'logout']);
    });


});

