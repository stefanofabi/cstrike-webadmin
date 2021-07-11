<?php

use Illuminate\Support\Facades\Route;
use App\Models\Server;
use App\Models\Ban;

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

Route::group(['middleware' => ['web']], function () {

    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);

        return \Redirect::back();
    })->where([
        'lang' => 'en|es',
    ]);
});

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

Route::get('buy_administrator', [App\Http\Controllers\Users\ProfileController::class, 'buyAdministrator'])->name('buy_administrator');

Route::get('show_ban/{id}', [App\Http\Controllers\ApiController::class, 'showBan'])
    ->name('show_ban')
    ->where('id', '[1-9][0-9]*');

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
        require('staffs/logs.php');
    });
});

Route::group(['middleware' => ['permission:is_user','auth']], function () {

    Route::group([
        'prefix' => 'users',
        'as' => 'users/',
    ], function () {
        
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('profiles/my_administrator', [App\Http\Controllers\Users\ProfileController::class, 'myAdministrator'])->name('profiles/my_administrator')
            ->middleware('administrator_associate');
        
        require('users/bans.php');
        require('users/players.php');
    });
});
