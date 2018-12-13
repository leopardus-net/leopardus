<?php

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function() {
    //
    Route::get('/', 'ProfileController@index')
        ->name('profile')
        ->middleware('permission:profile.view');

    Route::get('/information-tab', 'ProfileController@informationTab')
        ->name('profile.tab.info')
        ->middleware('permission:profile.view');
    
    Route::get('/settings', 'ProfileController@settings')
        ->name('profile.settings')
        ->middleware('permission:account.view');

    Route::group(['prefix' => 'update', 'middleware' => 'auth'], function() {
        //
        Route::post('/avatar', 'ProfileController@uploadProfileImage')
            ->name('profile.upload.avatar')
            ->middleware('permission:account.update');

        Route::post('/settings', 'ProfileController@update')
                ->name('profile.update.settings')
                ->middleware('permission:account.update');
                
        Route::post('/password', 'ProfileController@updatePassword')
                ->name('profile.update.password')
                ->middleware('permission:account.update');
	});
});