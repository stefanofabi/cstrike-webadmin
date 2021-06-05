<?php 

Route::group([
    'permission:crud_ranks',
    'prefix' => 'ranks',
    'as' => 'ranks/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Staffs\RankController', 'index'])->name('index');

    Route::get('create', ['\App\Http\Controllers\Staffs\RankController', 'create'])->name('create');

    Route::post('store', ['\App\Http\Controllers\Staffs\RankController', 'store'])->name('store');

    Route::post('edit', ['\App\Http\Controllers\Staffs\RankController', 'edit'])->name('edit');
            
    Route::post('update', ['\App\Http\Controllers\Staffs\RankController', 'update'])->name('update');
    
    Route::delete('destroy/{id}', ['\App\Http\Controllers\Staffs\RankController', 'destroy'])->name('destroy')->where('id', '[1-9][0-9]*');
    
});