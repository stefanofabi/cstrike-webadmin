<?php 

use App\Http\Controllers\Staffs\OrderController;

Route::controller(OrderController::class)
->prefix('orders')
->as('orders/')
->middleware('permission:crud_orders')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::get('create', 'create')->name('create');

    Route::post('store', 'store')->name('store');

    Route::post('edit', 'edit')->name('edit');
            
    Route::post('update', 'update')->name('update');
    
    Route::delete('destroy/{id}', 'destroy')->name('destroy');
    
    Route::post('activate/{id}', 'activate')->name('activate')->middleware('order_pending');

    Route::post('cancel/{id}', 'cancel')->name('cancel')->middleware('order_not_pending');

    Route::post('renew/{id}', 'renew')->name('renew')->middleware('order_not_pending');
});