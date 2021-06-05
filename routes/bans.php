<?php 

Route::group([
    'permission:crud_bans',
    'prefix' => 'bans',
    'as' => 'bans/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Staffs\BanController', 'index'])->name('index');

    Route::get('create', ['\App\Http\Controllers\Staffs\BanController', 'create'])->name('create');

    Route::post('store', ['\App\Http\Controllers\Staffs\BanController', 'store'])->name('store');

    Route::post('edit', ['\App\Http\Controllers\Staffs\BanController', 'edit'])->name('edit');
            
    Route::post('update', ['\App\Http\Controllers\Staffs\BanController', 'update'])->name('update');
    
    Route::delete('destroy/{id}', ['\App\Http\Controllers\Staffs\BanController', 'destroy'])->name('destroy')->where('id', '[1-9][0-9]*');
    
});