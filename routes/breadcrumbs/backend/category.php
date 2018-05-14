<?php

Breadcrumbs::register('admin.category.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.categories.management'), route('admin.category.index'));
});

Breadcrumbs::register('admin.category.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push(__('menus.backend.categories.deleted'), route('admin.category.deleted'));
});

Breadcrumbs::register('admin.category.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push(__('labels.backend.categories.create'), route('admin.category.create'));
});

Breadcrumbs::register('admin.category.show', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push(__('menus.backend.categories.view', ['product' => $category->name]), route('admin.category.show', $category));
});

Breadcrumbs::register('admin.category.edit', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('admin.category.index');
    $breadcrumbs->push(__('menus.backend.categories.edit', ['product' => $category->name]), route('admin.category.edit', $category));
});
