<?php 

use App\Http\Controllers\Staffs\SystemParameterController;

Route::controller(SystemParameterController::class)
->middleware('permission:crud_system_parameters')
->prefix('system_parameters')
->as('system_parameters/')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::post('edit', 'edit')->name('edit');
            
    Route::post('update', 'update')->name('update');
    
});