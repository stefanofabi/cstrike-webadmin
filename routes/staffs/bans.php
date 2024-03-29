<?php 

use App\Http\Controllers\Staffs\BanController;

Route::controller(BanController::class)
->middleware('permission:crud_bans')
->prefix('bans')
->as('bans/')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::get('create/{player_id?}', 'create')->name('create');

    Route::post('store','store')->name('store');

    Route::post('edit', 'edit')->name('edit');
            
    Route::post('update', 'update')->name('update');
    
    Route::delete('destroy/{id}', 'destroy')->name('destroy');
    
});