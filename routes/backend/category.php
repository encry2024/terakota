<?php

Route::group([
    'namespace' => 'Category'
], function () {

    Route::get('category/deleted', 'CategoryStatusController@getDeleted')->name('category.deleted');

    /*
     * Category CRUD
     */
    Route::resource('category', 'CategoryController');

    Route::group(['prefix' => 'category/{category}'], function () {
        // Deleted
        Route::get('delete', 'CategoryStatusController@delete')->name('category.delete-permanently');
        Route::get('restore', 'CategoryStatusController@restore')->name('category.restore');
    });

});