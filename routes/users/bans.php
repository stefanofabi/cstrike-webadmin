<?php 

Route::group([
    'middleware' => ['administrator_associate', 'administrator_with_ban'],
    'permission:crud_bans',
    'prefix' => 'bans',
    'as' => 'bans/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Users\BanController', 'index'])->name('index');

    Route::post('load', ['\App\Http\Controllers\Users\BanController', 'load'])->name('load');

    Route::get('create/{player_id?}', ['\App\Http\Controllers\Users\BanController', 'create'])->name('create')->where('player_id', '[1-9][0-9]*');

    Route::post('store', ['\App\Http\Controllers\Users\BanController', 'store'])->name('store')->middleware('administrator_with_server_access');

    Route::post('edit', ['\App\Http\Controllers\Users\BanController', 'edit'])->name('edit')
        ->middleware('administrator_with_ban_edit');
            
    Route::post('update', ['\App\Http\Controllers\Users\BanController', 'update'])->name('update')
        ->middleware('administrator_with_server_access')
        ->middleware('administrator_with_ban_edit');
    
    Route::delete('destroy/{id}', ['\App\Http\Controllers\Users\BanController', 'destroy'])->name('destroy')
        ->middleware('administrator_with_ban_edit')
        ->where('id', '[1-9][0-9]*');
    
});