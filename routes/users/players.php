<?php 

Route::group([
    'permission:crud_players',
    'prefix' => 'players',
    'as' => 'players/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Users\PlayerController', 'index'])->name('index'); 
});