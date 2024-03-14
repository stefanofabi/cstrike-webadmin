<?php 

Route::group([
    'permission:crud_servers',
    'prefix' => 'servers',
    'as' => 'servers/',
], function () {
    Route::get('index', ['\App\Http\Controllers\Staffs\ServerController', 'index'])->name('index');

    Route::get('create', ['\App\Http\Controllers\Staffs\ServerController', 'create'])->name('create');

    Route::post('store', ['\App\Http\Controllers\Staffs\ServerController', 'store'])->name('store');

    Route::post('edit', ['\App\Http\Controllers\Staffs\ServerController', 'edit'])->name('edit');
            
    Route::post('update', ['\App\Http\Controllers\Staffs\ServerController', 'update'])->name('update');
    
    Route::delete('destroy/{id}', ['\App\Http\Controllers\Staffs\ServerController', 'destroy'])->name('destroy')->where('id', '[1-9][0-9]*');
    
    Route::post('see-game-chat', ['\App\Http\Controllers\Staffs\ServerController', 'seeGameChat'])->name('see_game_chat');

});