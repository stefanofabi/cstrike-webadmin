<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::group(['middleware' => ['auth']], function () {

    Route::group([
        'prefix' => 'staff',
        'as' => 'staff/',
    ], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        

        Route::group([
            'prefix' => 'administrators',
            'as' => 'administrators/',
        ], function () {
            Route::get('index', ['\App\Http\Controllers\Staff\AdministratorController', 'index'])->name('index');

            Route::post('edit', ['\App\Http\Controllers\Staff\AdministratorController', 'edit'])->name('edit');
            
            Route::post('update', ['\App\Http\Controllers\Staff\AdministratorController', 'update'])->name('update');

            Route::delete('destroy/{id}', ['\App\Http\Controllers\Staff\AdministratorController', 'destroy'])->name('destroy')->where('id', '[1-9][0-9]*');
        });
    });
});
