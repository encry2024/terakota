<?php

Route::group([
    'namespace' =>  'Report',
    'prefix'    =>  'report',
    'as'        =>  'report.'
], function () {

    Route::resource('sales', 'SaleController');

});