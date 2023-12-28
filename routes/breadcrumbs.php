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

// Breadcrumbs for the 'frontend.product.search'
Breadcrumbs::for('frontend.product.search', function (BreadcrumbTrail $trail) {
    $trail->parent('frontend.product.index');
    $trail->push('Search', route('frontend.product.index'));
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
    $trail->push(__('Backend'), route('backend.admin.dashboard'));
});

// Breadcrumbs for 'backend.admin.dashboard'
Breadcrumbs::for('backend.admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('Action'), route('backend.admin.dashboard'));
});

/* ------------------------------------- Product  ------------------------------------- */

#region

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

// Breadcrumbs for 'backend.admin.product.search'
Breadcrumbs::for('backend.admin.product.search', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.product.management');
    $trail->push(__('Search'), route('backend.admin.product.management'));
});

// Breadcrumbs for 'backend.admin.product.edit'
Breadcrumbs::for('backend.admin.product.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('backend.admin.product.management');
    $trail->push(__('product.edit-panel'), route('backend.admin.product.edit', ["id" => $id]));
});

#endregion

/* ------------------------------------- Car Model  ------------------------------------- */

#region

// Breadcrumbs for 'backend.admin.model.index'
Breadcrumbs::for('backend.admin.model.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.model'));
});

// Breadcrumbs for 'backend.admin.model.create'
Breadcrumbs::for('backend.admin.model.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.model.index');
    $trail->push(__('model.create-panel'), route('backend.admin.model.create'));
});

// Breadcrumbs for 'backend.admin.model.management'
Breadcrumbs::for('backend.admin.model.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.model.index');
    $trail->push(__('model.management-panel'), route('backend.admin.model.edit'));
});

#endregion

/* ------------------------------------- Car Model  ------------------------------------- */

#region

// Breadcrumbs for 'backend.admin.category.index'
Breadcrumbs::for('backend.admin.category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.category'));
});

// Breadcrumbs for 'backend.admin.category.create'
Breadcrumbs::for('backend.admin.category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.category.index');
    $trail->push(__('category.create-panel'), route('backend.admin.category.create'));
});

// Breadcrumbs for 'backend.admin.category.management'
Breadcrumbs::for('backend.admin.category.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.category.index');
    $trail->push(__('category.management-panel'), route('backend.admin.category.edit'));
});

#endregion

/* ------------------------------------- Brand  ------------------------------------- */

#region

// Breadcrumbs for 'backend.admin.brand.index'
Breadcrumbs::for('backend.admin.brand.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.brand'));
});

// Breadcrumbs for 'backend.admin.brand.create'
Breadcrumbs::for('backend.admin.brand.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.brand.index');
    $trail->push(__('brand.create-panel'), route('backend.admin.brand.create'));
});

// Breadcrumbs for 'backend.admin.brand.management'
Breadcrumbs::for('backend.admin.brand.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.brand.index');
    $trail->push(__('brand.management-panel'), route('backend.admin.brand.edit'));
});

#endregion

/* ------------------------------------- Order  ------------------------------------- */

#region

// Breadcrumbs for 'backend.admin.order'
Breadcrumbs::for('backend.admin.order', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.order'));
});

// Breadcrumbs for 'backend.admin.order.index'
Breadcrumbs::for('backend.admin.order.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.order');
    $trail->push(__('order.view-order'), route('backend.admin.order.index'));
});

// Breadcrumbs for 'backend.admin.order.detail'
Breadcrumbs::for('backend.admin.order.detail', function (BreadcrumbTrail $trail, $order) {
    $trail->parent('backend.admin.order.index');
    $trail->push($order, route('backend.admin.order.detail', ["id" => $order]));
});

// Breadcrumbs for 'backend.admin.order.list'
Breadcrumbs::for('backend.admin.order.list', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.order');
    $trail->push(__('order.history-order'), route('backend.admin.order.list'));
});

#endregion

/* ------------------------------------- User Management Center ------------------------------------- */

#region

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

// Breadcrumbs for 'backend.admin.user.search'
Breadcrumbs::for('backend.admin.user.search', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.user.management');
    $trail->push(__('Search'), route('backend.admin.user.search')); // Use the correct route for management
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

#endregion

/* ------------------------------------- Role Management Center ------------------------------------- */

#region

// Breadcrumbs for 'backend.admin.role.index'
Breadcrumbs::for('backend.admin.role.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.role-management-center'), route('backend.admin.role.index'));
});

// Breadcrumbs for 'backend.admin.role.create'
Breadcrumbs::for('backend.admin.role.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.role.index');
    $trail->push(__('role.create-panel'), route('backend.admin.role.create'));
});

// Breadcrumbs for 'backend.admin.role.management'
Breadcrumbs::for('backend.admin.role.management', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.role.index');
    $trail->push(__('role.management-panel'), route('backend.admin.role.management'));
});

#endregion

/* ------------------------------------- Permission Management Center ------------------------------------- */

#region

// Breadcrumbs for 'backend.admin.permission.index'
Breadcrumbs::for('backend.admin.permission.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.permission-management-center'), route('backend.admin.permission.index'));
});

// Breadcrumbs for 'backend.admin.permission.create'
Breadcrumbs::for('backend.admin.permission.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.permission.index');
    $trail->push(__('permission.create-panel'), route('backend.admin.permission.create'));
});

// Breadcrumbs for 'backend.admin.permission.management'
Breadcrumbs::for('backend.admin.permission.management', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.permission.index');
    $trail->push(__('permission.management-panel'), route('backend.admin.permission.management'));
});

#endregion

/* ------------------------------------- Data Center ------------------------------------- */

#region

// Breadcrumbs for 'backend.admin.data.index'
Breadcrumbs::for('backend.admin.data.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin');
    $trail->push(__('sidebar.data-center'));
});

// Breadcrumbs for 'backend.admin.data.record'
Breadcrumbs::for('backend.admin.data.record', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.data.index');
    $trail->push(__('sidebar.operation-record'), route('backend.admin.data.record'));
});

// Breadcrumbs for 'backend.admin.data.record-search'
Breadcrumbs::for('backend.admin.data.record-search', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.data.record');
    $trail->push(__('Search'), route('backend.admin.data.record-search'));
});

// Breadcrumbs for 'backend.admin.data.import'
Breadcrumbs::for('backend.admin.data.import', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.data.index');
    $trail->push(__('sidebar.import-data'), route('backend.admin.data.import'));
});

// Breadcrumbs for 'backend.admin.data.export'
Breadcrumbs::for('backend.admin.data.export', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.admin.data.index');
    $trail->push(__('sidebar.export-data'), route('backend.admin.data.export'));
});

#endregion

/* ------------------------------------- [User Backend]  ------------------------------------- */

Breadcrumbs::for('backend.user', function (BreadcrumbTrail $trail) {
    $trail->parent('backend');
    $trail->push('Backend');
});

/* ------------------------------------- Data [User Backend]  ------------------------------------- */

#region

// Breadcrumbs for 'backend.user.data.index'
Breadcrumbs::for('backend.user.data.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.user');
    $trail->push('Profile', route('backend.user.data.index'));
});

#endregion

/* ------------------------------------- Cart [User Backend]  ------------------------------------- */

#region

// Breadcrumbs for 'backend.user.cart.create'
Breadcrumbs::for('backend.user.cart.create', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.user');
    $trail->push('Cart', route('backend.user.cart.create'));
});

#endregion

/* ------------------------------------- Order [User Backend]  ------------------------------------- */

#region

// Breadcrumbs for 'backend.user.order.index'
Breadcrumbs::for('backend.user.order.index', function (BreadcrumbTrail $trail) {
    $trail->parent('backend.user');
    $trail->push('Order', route('backend.user.order.index'));
});

#endregion