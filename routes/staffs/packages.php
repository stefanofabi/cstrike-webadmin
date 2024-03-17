<?php 

use App\Http\Controllers\Staffs\PackageController;
use App\Http\Controllers\Staffs\PrivilegeController;

Route::controller(PackageController::class)
->prefix('packages')
->as('packages/')
->middleware('permission:crud_packages')
->group(function () {
    Route::get('index', 'index')->name('index');

    Route::get('create', 'create')->name('create');

    Route::post('store', 'store')->name('store');

    Route::post('edit', 'edit')->name('edit')->where('id', '[1-9][0-9]*');

    Route::put('update', 'update')->name('update')->where('id', '[1-9][0-9]*');

    Route::delete('destroy/{id}', 'destroy')->name('destroy')->where('id', '[1-9][0-9]*');

    Route::post('get_privileges', 'getPrivileges')->name('get_privileges');

    Route::controller(PrivilegeController::class)
    ->prefix('privileges')
    ->as('privileges/')
    ->group(function () {

        Route::post('store', 'store')->name('store');
    
        Route::post('destroy', 'destroy')->name('destroy');
    
    });
});