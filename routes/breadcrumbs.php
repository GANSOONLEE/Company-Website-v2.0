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
    $trail->push($product->product_category, route('frontend.product', $product->product_category));
});

// Home > [Category] > [ProductDetail]
Breadcrumbs::for('productDetail', function (BreadcrumbTrail $trail, $product, $productData) {
    $trail->parent('product', $product);
    $trail->push($productData->product_code, route('frontend.product-detail', $productData->product_code));
});

