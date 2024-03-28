<?php 

use App\Http\Controllers\Users\OrderController;

Route::controller(OrderController::class)
->prefix('orders')
->as('orders/')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::get('create', 'create')->name('create');

    Route::post('store', 'store')->name('store');

    Route::get('pay/{id}', 'pay')->name('pay')->middleware('is_my_order');

});