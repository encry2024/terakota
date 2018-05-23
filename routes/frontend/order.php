<?php
Route::group(['middleware' => 'auth'], function () {
    Route::group([
        'namespace' => 'Order',
        'prefix'    =>  'cashier',
        'as'        => 'cashier.order.',
    ], function () {
        /*
        * Cashier POS Specific
        */
        Route::get('table/{dining}/order/create', 'OrderController@create')->name('create');

        Route::post('table/{dining}/order/pending', 'OrderController@getPendings')->name('get_pendings');
        Route::post('table/{dining}/order/save', 'OrderController@save')->name('save');

        Route::delete('table/{dining}/order/remove', 'OrderController@remove')->name('remove_item');
    });
});