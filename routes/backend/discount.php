<?php

Route::group([
    'namespace' => 'Discount'
], function () {

    Route::get('discount/deleted', 'DiscountStatusController@getDeleted')->name('discount.deleted');

    /*
     * Discount CRUD
     */
    Route::resource('discount', 'DiscountController');

    Route::group(['prefix' => 'discount/{discount}'], function () {
        // Deleted
        Route::get('delete', 'DiscountStatusController@delete')->name('discount.delete-permanently');
        Route::get('restore', 'DiscountStatusController@restore')->name('discount.restore');
    });

});