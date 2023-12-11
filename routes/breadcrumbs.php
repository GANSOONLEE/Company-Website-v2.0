<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('frontend.home'));
});

// Home > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Category', route('frontend.category'));
});

// Home > [Category]
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('category');

    $trail->push($product, route('frontend.product', $product));
});

// Home > [Category] > [?Model]
Breadcrumbs::for('model', function (BreadcrumbTrail $trail, $product, $model = null) {
    $trail->parent('product', $product);
    if(!isset($model)){
        $trail->push('Unknown');
    }else{
        $trail->push($model, route('frontend.product.search.post', ['productCategory' => $product, 'model' => $model]));
    };
});

// Home > [Category] > [?Model] > [ProductDetail]
Breadcrumbs::for('productDetail', function (BreadcrumbTrail $trail, $product, $model, $productData) {
    if(count($productData->getProductName()) <= 0){
        $trail->parent('model', $product->product_category);
        $trail->push('Unknown', route('frontend.product-detail', ''));
    }else{
        $trail->parent('model', $product->product_category, $model);
        $trail->push($productData->getProductName()[0]->name, route('frontend.product-detail', $productData->getProductName()[0]->name));
    };
});

// Home > Order (User)
Breadcrumbs::for('order', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push('Order', route('backend.user.order'));
});

// Home > Order > [Order Detail] (User)
Breadcrumbs::for('orderDetail', function (BreadcrumbTrail $trail, $order){
    $trail->parent('order');
    $trail->push($order->code, route('backend.user.order-detail', $order->code));
});

// Home > Order (Admin)
Breadcrumbs::for('order-admin', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push('Order', route('backend.admin.order.index'));
});

// Home > Order > [Order Detail] (Admin)
Breadcrumbs::for('orderDetail-admin', function (BreadcrumbTrail $trail, $order){
    $trail->parent('order-admin');
    $trail->push($order->code, route('backend.admin.order.order-detail', $order->code));
});

/* ------------------------------------- Backend ------------------------------------- */

// Breadcrumbs for the 'backend' home
Breadcrumbs::for('backend', function (BreadcrumbTrail $trail) {
    // Define breadcrumbs for the backend home
});

// Breadcrumbs for 'backend.admin'
Breadcrumbs::for('backend.admin', function (BreadcrumbTrail $trail) {
    $trail->parent('backend');
    $trail->push(__('Backend'));
});

/* ------------------------------------- User Management Center ------------------------------------- */

// Breadcrumbs for 'backend.admin.user.index'
Breadcrumbs::for('backend.admin.user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.user-management-center'), route('backend.admin.user.index'));
});

// Breadcrumbs for 'backend.admin.user.create'
Breadcrumbs::for('backend.admin.user.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.user.index');
    $trail->push(__('user.create-panel'), route('backend.admin.user.create')); // Use the correct route for create
});

// Breadcrumbs for 'backend.admin.user.management'
Breadcrumbs::for('backend.admin.user.management', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.user.index');
    $trail->push(__('user.management-panel'), route('backend.admin.user.management')); // Use the correct route for management
});

// Breadcrumbs for 'backend.admin.user.permission'
Breadcrumbs::for('backend.admin.user.permission', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.user.index');
    $trail->push(__('user.permission-panel'), route('backend.admin.user.permission')); // Use the correct route for permission
});

// Breadcrumbs for 'backend.admin.user.ban'
Breadcrumbs::for('backend.admin.user.ban', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.user.index');
    $trail->push(__('user.ban-panel'), route('backend.admin.user.ban')); // Use the correct route for ban
});

/* ------------------------------------- User Management Center ------------------------------------- */

// Breadcrumbs for 'backend.admin.product.index'
Breadcrumbs::for('backend.admin.product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.product'), route('backend.admin.user.index'));
});
