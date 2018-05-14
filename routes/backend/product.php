<?php

Route::group([
    'namespace' => 'Product'
], function () {

    Route::get('product/deleted', 'ProductStatusController@getDeleted')->name('product.deleted');

    /*
     * Product CRUD
     */
    Route::resource('product', 'ProductController');

    Route::group(['prefix' => 'product/{product}'], function () {
        // Deleted
        Route::get('delete', 'ProductStatusController@delete')->name('product.delete-permanently');
        Route::get('restore', 'ProductStatusController@restore')->name('product.restore');
    });

});