<?php

Breadcrumbs::register('admin.report.sales.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.sales.management'), route('admin.report.sales.index'));
});