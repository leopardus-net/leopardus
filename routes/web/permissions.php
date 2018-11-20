<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //

    Route::group(['prefix' => 'permissions'], function() {
        //
        Route::get('/', 'PermissionsController@index');
        Route::get('role/{id}', 'PermissionsController@getRole')->name('roles.get');
        Route::post('store/{id?}', 'PermissionsController@store');
        Route::post('setPermissionRole', 'PermissionsController@togglePermissionToRole');
        Route::get('update/{id}', 'PermissionsController@update')->name('roles.edit');
        Route::delete('destory/{id}', 'PermissionsController@destroy')->name('roles.destroy');
    });
});