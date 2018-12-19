<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //

    Route::group(['prefix' => 'permissions'], function() {
        //
        Route::get('/', 'PermissionsController@index')
            ->name('permissions.index')
            ->middleware('permission:permissions.view');

        Route::post('store/{id?}', 'PermissionsController@store')
            ->name('permissions.store')
            ->middleware('permission:permissions.store');

        Route::get('update/{id}', 'PermissionsController@modify')
            ->name('permissions.modify')
            ->middleware('permission:permissions.update');

        Route::put('update/{id}', 'PermissionsController@update')
            ->name('permissions.update')
            ->middleware('permission:permissions.update');

        Route::delete('destory/{id}', 'PermissionsController@destroy')
            ->name('permissions.destroy')
            ->middleware('permission:permissions.delete');
    });

    Route::group(['prefix' => 'roles'], function() {
        //
        Route::get('/', 'RolesController@index')
            ->name('roles.index')
            ->middleware('permission:roles.view');

        Route::post('store/{id?}', 'RolesController@store')
            ->name('roles.store')
            ->middleware('permission:roles.store');
            
        Route::get('update/{id}', 'RolesController@modify')
            ->name('roles.modify')
            ->middleware('permission:roles.update');

        Route::put('update/{id}', 'RolesController@update')
            ->name('roles.update')
            ->middleware('permission:roles.update');

        Route::delete('destory/{id}', 'RolesController@destroy')
            ->name('roles.destroy')
            ->middleware('permission:roles.delete');

        Route::post('setPermissionRole', 'RolesController@togglePermissionToRole')
            ->name('roles.setPermissionToRole')
            ->middleware('permission:roles.assingPermission');
    });
});