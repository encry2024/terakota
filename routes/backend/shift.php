<?php

Route::group([
    'namespace' => 'Shift'
], function () {

    Route::get('shift/deleted', 'ShiftStatusController@getDeleted')->name('shift.deleted');

    /*
     * Shift CRUD
     */
    Route::resource('shift', 'ShiftController');

    Route::group(['prefix' => 'shift/{shift}'], function () {
        // Deleted
        Route::get('delete', 'ShiftStatusController@delete')->name('shift.delete-permanently');
        Route::get('restore', 'ShiftStatusController@restore')->name('shift.restore');
    });

});