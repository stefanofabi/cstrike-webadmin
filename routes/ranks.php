<?php 

Route::group([
    'prefix' => 'ranks',
    'as' => 'ranks/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Staff\RankController', 'index'])->name('index');

    Route::get('create', ['\App\Http\Controllers\Staff\RankController', 'create'])->name('create');

    Route::post('store', ['\App\Http\Controllers\Staff\RankController', 'store'])->name('store');

    Route::post('edit', ['\App\Http\Controllers\Staff\RankController', 'edit'])->name('edit');
            
    Route::post('update', ['\App\Http\Controllers\Staff\RankController', 'update'])->name('update');
    
    Route::delete('destroy/{id}', ['\App\Http\Controllers\Staff\RankController', 'destroy'])->name('destroy')->where('id', '[1-9][0-9]*');
    
});