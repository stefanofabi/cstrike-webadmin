<?php

use Illuminate\Support\Facades\Route;
use App\Models\Server;

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

    if ($user = auth()->user()) {
        if ($user->hasPermissionTo('is_staff')) {
            return redirect()->route('staffs/home');
        }

        if ($user->hasPermissionTo('is_user')) {
            return redirect()->route('users/home');
        }
    }

    // guest
    $servers = Server::orderBy('ip', 'ASC')->get();
    return view('welcome')->with('servers', $servers);
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::group([
        'prefix' => 'auth',
        'as' => 'auth/',
    ], function () {
        Route::get('change_password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'edit'])->name('change_password');
        Route::post('change_password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'update'])->name('change_password');

        Route::get('change_avatar', [App\Http\Controllers\AvatarController::class, 'edit'])->name('change_avatar');
        Route::post('change_avatar', [App\Http\Controllers\AvatarController::class, 'update'])->name('change_avatar');
    });
});



Route::group(['middleware' => ['permission:is_staff','auth']], function () {

    Route::group([
        'prefix' => 'staffs',
        'as' => 'staffs/',
    ], function () {
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        require('staffs/administrators.php');
        require('staffs/ranks.php');
        require('staffs/servers.php');
        require('staffs/bans.php');
        require('staffs/players.php');
    });
});

Route::group(['middleware' => ['permission:is_user','auth']], function () {

    Route::group([
        'prefix' => 'users',
        'as' => 'users/',
    ], function () {
        
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        require('users/bans.php');
        require('users/players.php');
    });
});
