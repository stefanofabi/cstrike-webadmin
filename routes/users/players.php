<?php 

use App\Http\Controllers\Users\PlayerController;

Route::controller(PlayerController::class)
->middleware(['administrator_associate'])
->prefix('players')
->as('players/')
->group(function () {
    Route::get('index', 'index')->name('index'); 
    
});