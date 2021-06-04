<?php 

Route::group([
    'prefix' => 'administrators',
    'as' => 'administrators/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Staffs\AdministratorController', 'index'])->name('index');

    Route::get('create', ['\App\Http\Controllers\Staffs\AdministratorController', 'create'])->name('create');

    Route::post('store', ['\App\Http\Controllers\Staffs\AdministratorController', 'store'])->name('store');

    Route::post('edit', ['\App\Http\Controllers\Staffs\AdministratorController', 'edit'])->name('edit');
            
    Route::post('update', ['\App\Http\Controllers\Staffs\AdministratorController', 'update'])->name('update');

    Route::delete('destroy/{id}', ['\App\Http\Controllers\Staffs\AdministratorController', 'destroy'])->name('destroy')->where('id', '[1-9][0-9]*');
    
});