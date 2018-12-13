<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //
    Route::group(['prefix' => 'users'], function() {
        //
        Route::get('/', 'UsersController@index')
            ->name('admin.users.index')
            ->middleware('permission:users.view');
        
        Route::get('/view/{id}', 'UsersController@getUserDetails')
            ->name('admin.user-details')
            ->middleware('permission:users.details');

        Route::post('store', 'UsersController@store')
            ->name('users.store')
            ->middleware('permission:users.store');

        Route::post('destroy/{id}', 'UsersController@destroy')
            ->name('users.destroy')
            ->middleware('permission:users.delete');

        Route::post('change-role', 'UsersController@changeRole')
            ->name('users.change-role')
            ->middleware('permission:users.update');
    });
});