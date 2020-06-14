<?php

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Home', route('dashboard'));
});




//Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('categories'));
});

//Brands
Breadcrumbs::for('brands', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Brands', route('brands'));
});

//Products
Breadcrumbs::for('add.product', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Add Product', route('add.product'));
});

Breadcrumbs::for('view.products', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('View Products', route('view.products'));
});

Breadcrumbs::for('edit.product', function ($trail, $product) {
    $trail->parent('view.products',$product);
    $trail->push('Edit Product', route('edit.product', $product->id));
});



//Orders
Breadcrumbs::for('view.orders', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Orders', route('view.orders'));
});


Breadcrumbs::for('view.order', function ($trail, $orderDetails) {
    $trail->parent('view.orders',$orderDetails);
    $trail->push('Order ID: '.$orderDetails->id , route('view.order', $orderDetails->id));
});

//Banners
Breadcrumbs::for('banners', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Banners And Sliders', route('banners'));
});


//Coupons
Breadcrumbs::for('add.coupon', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Add Coupon', route('add.coupon'));
});

Breadcrumbs::for('view.coupons', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('View Coupons', route('view.coupons'));
});

Breadcrumbs::for('edit.coupon', function ($trail, $couponDetails) {
    $trail->parent('view.coupons',$couponDetails);
    $trail->push('Edit Coupon | '.$couponDetails->id, route('edit.coupon', $couponDetails->id));
});




//Teams
Breadcrumbs::for('team.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Team Members', route('team.index'));
});

Breadcrumbs::for('team.add', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Add Team Member', route('team.add'));
});

Breadcrumbs::for('team.show', function ($trail, $team) {
    $trail->parent('team.index');
    $trail->push($team->name, route('team.show', $team->id));
});
Breadcrumbs::for('team.edit', function ($trail, $team) {
    $trail->parent('team.show',$team);
    $trail->push('edit', route('team.edit', $team->id));
});


//Users
Breadcrumbs::for('show.users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Admins', route('show.users'));
});

Breadcrumbs::for('add.user', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Add New Admin', route('add.user'));
});

//Subscribers
Breadcrumbs::for('subscribers', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Subscribers', route('subscribers'));
});

//Testimonies
Breadcrumbs::for('add.testimony', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Add Testimony', route('add.testimony'));
});

Breadcrumbs::for('index.testimony', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Testimonies', route('index.testimony'));
});


Breadcrumbs::for('show.testimony', function ($trail, $testimony) {
    $trail->parent('index.testimony');
    $trail->push($testimony->name, route('show.testimony', $testimony->id));
});

Breadcrumbs::for('edit.testimony', function ($trail, $testimony) {
    $trail->parent('show.testimony',$testimony);
    $trail->push('edit', route('edit.testimony', $testimony->id));
});






//Logged In
Breadcrumbs::for('edit.profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('edit.profile'));
});

Breadcrumbs::for('edit.password', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Password', route('edit.password'));
});
