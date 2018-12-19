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

        Route::get('/{id}/information-tab', 'UsersController@userInformationTab')
            ->name('admin.profile.tab.info')
            ->middleware('permission:users.details');

        ##################################

        Route::get('/setting/{id}', 'UsersController@getUserSettings')
            ->name('admin.user-settings')
            ->middleware('permission:users.update');

        Route::get('{id}/settings-information-tab', 'UsersController@settingsInformationTab')
            ->name('admin.profile.settings.tab.info')
            ->middleware('permission:users.update');

        Route::get('{id}/settings-security-tab', 'UsersController@settingsSecurityTab')
            ->name('admin.profile.settings.tab.security')
            ->middleware('permission:users.update');


        ###################################

        Route::group(['prefix' => 'update', 'middleware' => 'auth'], function() {
            //
            Route::post('{id}/avatar', 'UsersController@uploadProfileImage')
                ->name('admin.profile.upload.avatar')
                ->middleware('permission:users.update');
    
            Route::put('{id}/settings', 'UsersController@update')
                    ->name('admin.profile.update.settings')
                    ->middleware('permission:users.update');
                    
            Route::put('{id}/password', 'UsersController@updatePassword')
                    ->name('admin.profile.update.password')
                    ->middleware('permission:users.update');
        });

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