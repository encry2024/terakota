<?php

Breadcrumbs::register('admin.dining.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.dinings.management'), route('admin.dining.index'));
});

Breadcrumbs::register('admin.dining.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dining.index');
    $breadcrumbs->push(__('menus.backend.dinings.deleted'), route('admin.dining.deleted'));
});

Breadcrumbs::register('admin.dining.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dining.index');
    $breadcrumbs->push(__('labels.backend.dinings.create'), route('admin.dining.create'));
});

Breadcrumbs::register('admin.dining.show', function ($breadcrumbs, $dining) {
    $breadcrumbs->parent('admin.dining.index');
    $breadcrumbs->push(__('menus.backend.dinings.view', ['dining' => $dining->name]), route('admin.dining.show', $dining));
});

Breadcrumbs::register('admin.dining.edit', function ($breadcrumbs, $dining) {
    $breadcrumbs->parent('admin.dining.index');
    $breadcrumbs->push(__('menus.backend.dinings.edit', ['dining' => $dining->name]), route('admin.dining.edit', $dining));
});
