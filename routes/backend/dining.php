<?php

Route::group([
    'namespace' => 'Dining'
], function () {

    Route::get('dining/deleted', 'DiningStatusController@getDeleted')->name('dining.deleted');

    /*
     * Dining CRUD
     */
    Route::resource('dining', 'DiningController');

    Route::group(['prefix' => 'dining/{dining}'], function () {
        // Deleted
        Route::get('delete', 'DiningStatusController@delete')->name('dining.delete-permanently');
        Route::get('restore', 'DiningStatusController@restore')->name('dining.restore');
    });

});