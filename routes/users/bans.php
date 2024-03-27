<?php 

use App\Http\Controllers\Users\BanController;

Route::controller(BanController::class)
->middleware(['administrator_associate'])
->prefix('bans')
->as('bans/')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::get('create/{player_id?}', 'create')->name('create');

    Route::post('store', 'store')->name('store')->middleware('administrator_with_server_access');

    Route::post('edit', 'edit')->name('edit')
        ->middleware('administrator_with_ban_access');
            
    Route::post('update', 'update')->name('update')
        ->middleware('administrator_with_server_access')
        ->middleware('administrator_with_ban_access');
    
    Route::delete('destroy/{id}', 'destroy')->name('destroy')
        ->middleware('administrator_with_ban_access');
    
});