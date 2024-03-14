<?php 

use \Spatie\Activitylog\Models\Activity;

Route::group([
    'prefix' => 'logs',
    'as' => 'logs/',
], function () {
    Route::get('logs/activity_logs', function () {
        $activities = Activity::all();

        return view('staffs/logs/activity_logs')
            ->with('activities', $activities);
    })
        ->name('activity_logs')
        ->middleware('permission:activity_logs');
});