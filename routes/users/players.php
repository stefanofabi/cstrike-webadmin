<?php 

Route::group([
    'middleware' => ['administrator_associate'],
    'permission:crud_players',
    'prefix' => 'players',
    'as' => 'players/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Users\PlayerController', 'index'])->name('index'); 
});