<?php 

use App\Http\Controllers\Users\PlayerController;

Route::controller(PlayerController::class)
->prefix('players')
->as('players/')
->group(function () {
    Route::get('index', 'index')->name('index'); 
    
});