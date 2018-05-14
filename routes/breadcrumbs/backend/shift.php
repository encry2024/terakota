<?php

Breadcrumbs::register('admin.shift.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.shifts.management'), route('admin.shift.index'));
});

Breadcrumbs::register('admin.shift.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.shift.index');
    $breadcrumbs->push(__('menus.backend.shifts.deleted'), route('admin.shift.deleted'));
});

Breadcrumbs::register('admin.shift.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.shift.index');
    $breadcrumbs->push(__('labels.backend.shifts.create'), route('admin.shift.create'));
});

Breadcrumbs::register('admin.shift.show', function ($breadcrumbs, $shift) {
    $breadcrumbs->parent('admin.shift.index');
    $breadcrumbs->push(__('menus.backend.shifts.view', ['shift' => $shift->name]), route('admin.shift.show', $shift));
});

Breadcrumbs::register('admin.shift.edit', function ($breadcrumbs, $shift) {
    $breadcrumbs->parent('admin.shift.index');
    $breadcrumbs->push(__('menus.backend.shifts.edit', ['shift' => $shift->name]), route('admin.shift.edit', $shift));
});
