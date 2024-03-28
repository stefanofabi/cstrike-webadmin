<?php 

use App\Http\Controllers\Users\AdministratorController;

Route::controller(AdministratorController::class)
->prefix('administrators')
->as('administrators/')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::post('edit', 'edit')->name('edit')->middleware('is_my_administrator');
    
});