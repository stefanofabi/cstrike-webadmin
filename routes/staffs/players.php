<?php 

Route::group([
    'permission:crud_players',
    'prefix' => 'players',
    'as' => 'players/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Staffs\PlayerController', 'index'])->name('index');
            
    Route::delete('destroy/{id}', ['\App\Http\Controllers\Staffs\PlayerController', 'destroy'])->name('destroy')->where('id', '[1-9][0-9]*');
    
});