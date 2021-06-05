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

    if (auth()->user()) {
        return redirect()->action(['\App\Http\Controllers\HomeController', 'index']);
    }

    // guest
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['permission:is_staff','auth']], function () {

    Route::group([
        'prefix' => 'staffs',
        'as' => 'staffs/',
    ], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        require('administrators.php');
        require('ranks.php');
        require('servers.php');
        require('bans.php');
    });
});
