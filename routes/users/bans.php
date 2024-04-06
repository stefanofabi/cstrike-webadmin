<?php 

use App\Http\Controllers\Users\BanController;

Route::controller(BanController::class)
->prefix('bans')
->as('bans/')
->group(function () {
    Route::get('index', 'index')->name('index')->middleware('see_bans');

    Route::get('create/{player_id?}', 'create')->name('create');

    Route::post('store', 'store')->name('store')->middleware(['access_to_ban', 'administrator_with_server_access', 'administrator_with_higher_immunity']);

    Route::post('edit', 'edit')->name('edit')
        ->middleware('is_my_ban');
            
    Route::post('update', 'update')->name('update')
        ->middleware(['is_my_ban', 'administrator_with_server_access' ,'administrator_with_higher_immunity']);
    
    Route::delete('destroy/{id}', 'destroy')->name('destroy')
        ->middleware('is_my_ban');
    
});