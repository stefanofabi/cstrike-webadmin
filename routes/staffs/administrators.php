<?php 

use App\Http\Controllers\Staffs\AdministratorController;

Route::controller(AdministratorController::class)
->prefix('administrators')
->as('administrators/')
->middleware('permission:crud_administrators')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::get('create', 'create')->name('create');

    Route::post('store', 'store')->name('store');

    Route::post('edit', 'edit')->name('edit');
            
    Route::post('update', 'update')->name('update');

    Route::delete('destroy/{id}', 'destroy')->name('destroy');

    Route::post('load_users', 'load_users')->name('load_users');
    
});