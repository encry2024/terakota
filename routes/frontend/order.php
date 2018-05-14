<?php

Route::group([
    'namespace' => 'Order',
    'prefix'    =>  'cashier',
    'as'        => 'cashier.order.',
], function () {
    /*
     * Cashier POS Specific
     */
    Route::get('table/{dining}/order/create', 'OrderController@create')->name('create');
});