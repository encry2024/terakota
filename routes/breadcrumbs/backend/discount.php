<?php

Breadcrumbs::register('admin.discount.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.discounts.management'), route('admin.discount.index'));
});

Breadcrumbs::register('admin.discount.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.discount.index');
    $breadcrumbs->push(__('menus.backend.discounts.deleted'), route('admin.discount.deleted'));
});

Breadcrumbs::register('admin.discount.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.discount.index');
    $breadcrumbs->push(__('labels.backend.discounts.create'), route('admin.discount.create'));
});

Breadcrumbs::register('admin.discount.show', function ($breadcrumbs, $discount) {
    $breadcrumbs->parent('admin.discount.index');
    $breadcrumbs->push(__('menus.backend.discounts.view', ['discount' => $discount->name]), route('admin.discount.show', $discount));
});

Breadcrumbs::register('admin.discount.edit', function ($breadcrumbs, $discount) {
    $breadcrumbs->parent('admin.discount.index');
    $breadcrumbs->push(__('menus.backend.discounts.edit', ['discount' => $discount->name]), route('admin.discount.edit', $discount));
});
