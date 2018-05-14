<?php

Breadcrumbs::register('admin.product.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.products.management'), route('admin.product.index'));
});

Breadcrumbs::register('admin.product.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.product.index');
    $breadcrumbs->push(__('menus.backend.products.deleted'), route('admin.product.deleted'));
});

Breadcrumbs::register('admin.product.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.product.index');
    $breadcrumbs->push(__('labels.backend.products.create'), route('admin.product.create'));
});

Breadcrumbs::register('admin.product.show', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('admin.product.index');
    $breadcrumbs->push(__('menus.backend.products.view', ['product' => $product->name]), route('admin.product.show', $product));
});

Breadcrumbs::register('admin.product.edit', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('admin.product.index');
    $breadcrumbs->push(__('menus.backend.products.edit', ['product' => $product->name]), route('admin.product.edit', $product));
});
