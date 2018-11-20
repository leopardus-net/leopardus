<?php

Route::group(['prefix' => 'admin/settings/basic', 'middleware' => 'auth'], function() {
    //
    Route::get('/', 'SettingsController@index')->name('admin.settings');
    Route::put('/', 'SettingsController@store')->name('admin.settings.update');
});