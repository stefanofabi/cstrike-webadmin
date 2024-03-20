<?php 

use App\Http\Controllers\Staffs\OrderController;

Route::controller(OrderController::class)
->prefix('orders')
->as('orders/')
->middleware('permission:crud_orders')
->group(function () {
    Route::get('index', ['\App\Http\Controllers\Staffs\OrderController', 'index'])->name('index');

    Route::get('create', ['\App\Http\Controllers\Staffs\OrderController', 'create'])->name('create');

    Route::post('store', ['\App\Http\Controllers\Staffs\OrderController', 'store'])->name('store');

    Route::post('edit', ['\App\Http\Controllers\Staffs\OrderController', 'edit'])->name('edit');
            
    Route::post('update', ['\App\Http\Controllers\Staffs\OrderController', 'update'])->name('update');
    
    Route::delete('destroy/{id}', ['\App\Http\Controllers\Staffs\OrderController', 'destroy'])->name('destroy');
    
});