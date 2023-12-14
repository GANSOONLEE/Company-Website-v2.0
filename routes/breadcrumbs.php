<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/* ------------------------------------- Frontend ------------------------------------- */

// Breadcrumbs for the 'frontend.home'
Breadcrumbs::for('frontend.home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('frontend.home'));
});

/* ------------------- Product ------------------- */

// Breadcrumbs for the 'frontend.product.index'
Breadcrumbs::for('frontend.product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('frontend.home');
    $trail->push('Category', route('frontend.product.index'));
});

// Breadcrumbs for the 'frontend.product.list'
Breadcrumbs::for('frontend.product.list', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('frontend.product.index');
    $trail->push($category, route('frontend.product.list', ["category" => $category]));
});

// Breadcrumbs for the 'frontend.product.query'
Breadcrumbs::for('frontend.product.query', function (BreadcrumbTrail $trail, $category, $model) {
    $trail->parent('frontend.product.list', $category);
    $trail->push($model, route('frontend.product.query', ["category" => $category, "model" => $model]));
});

/* ------------------------------------- Backend ------------------------------------- */

// Breadcrumbs for the 'backend'
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
    $trail->push(__('sidebar.product'), route('backend.admin.product.index'));
});

// Breadcrumbs for 'backend.admin.product.create'
Breadcrumbs::for('backend.admin.product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.product.index');
    $trail->push(__('product.create-panel'), route('backend.admin.product.create'));
});

// Breadcrumbs for 'backend.admin.product.management'
Breadcrumbs::for('backend.admin.product.management', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.product.index');
    $trail->push(__('product.management-panel'), route('backend.admin.product.management'));
});
