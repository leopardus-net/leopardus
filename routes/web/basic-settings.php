<?php

Route::group(['prefix' => 'admin/settings/basic', 'middleware' => 'auth'], function() {
    //
    Route::get('/', 'SettingsController@index')
        ->name('admin.settings')
        ->middleware('permission:settings.basic.view');

    Route::put('/', 'SettingsController@store')
        ->name('admin.settings.update')
        ->middleware('permission:settings.basic.update');
});