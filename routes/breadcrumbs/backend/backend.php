<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
require __DIR__.'/product.php';
require __DIR__.'/category.php';
require __DIR__.'/shift.php';
require __DIR__.'/dining.php';
require __DIR__.'/discount.php';
require __DIR__.'/report.php';