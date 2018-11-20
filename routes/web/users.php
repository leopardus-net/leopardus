<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //
    Route::group(['prefix' => 'users'], function() {
        //
        Route::get('/', 'UsersController@index');
        Route::get('/view/{id}', 'UsersController@getUserDetails')->name('admin.user-details');
        Route::get('create', 'UsersController@create');
        Route::post('store', 'UsersController@store')->name('users.store');
        Route::post('update/{id}', 'UsersController@update')->name('users.update');
        Route::post('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
        Route::post('change-role', 'UsersController@changeRole')->name('users.change-role');
    });
});