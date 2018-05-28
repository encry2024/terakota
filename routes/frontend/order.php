<?php
Route::group(['middleware' => 'auth'], function () {
    Route::group([
        'namespace' => 'Order',
        'prefix'    => 'cashier',
        'as'        => 'cashier.',
    ], function () {
        /*
        * Cashier POS Specific
        */
        Route::get('order/{order}/dining/{dining}/create', 'OrderController@create')->name('order.create_order');

        Route::post('order/{order}/pending', 'OrderController@getPendings')->name('order.get_pendings');
        Route::post('order/{order}/save', 'OrderController@save')->name('order.save');
        Route::post('order/dining/check_availability', 'OrderController@orderCheckAvailability')->name('order.check_availability');
        Route::post('order/{order}/cancel', 'OrderController@cancel')->name('order.cancel');

        Route::resource('order', 'OrderController');

        Route::delete('table/{dining}/order/remove', 'OrderController@remove')->name('order.remove_item');
    });
});