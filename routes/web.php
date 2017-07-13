<?php

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

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('dashboard/{year?}/{week?}', 'DashboardController@index')
        ->where([
            'year' => '(199\d|20[0-9]\d)',
            'week' => '(5[0-3]|[1-4][0-9]|0?[1-9])'
        ])
        ->name('dashboard');

    Route::resource('date-entries', 'DateEntryController', [
        'only' => [
            'store', 'update', 'destroy'
        ]
    ]);

    Route::resource('users', 'UserController', [
        'only' => [
            'edit', 'update', 'destroy',
        ]
    ]);
    Route::get('profile', 'UserController@profile')->name('profile');

    Route::get('/{year?}/{week?}', function($year = null, $week = null) {
        return redirect()->route('dashboard', [$year ?? date('Y'), $week ?? date('W')]);
    });
});
