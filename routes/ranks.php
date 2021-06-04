<?php 

Route::group([
    'prefix' => 'ranks',
    'as' => 'ranks/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Staff\RankController', 'index'])->name('index');

    Route::get('create', ['\App\Http\Controllers\Staff\RankController', 'create'])->name('create');
});