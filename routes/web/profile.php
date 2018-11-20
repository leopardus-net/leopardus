<?php

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function() {
    //
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::get('/settings', 'ProfileController@settings')->name('profile.settings');
    Route::post('/upload-avatar', 'ProfileController@uploadProfileImage')->name('profile.upload.avatar');

    Route::get('/information-tab', 'ProfileController@informationTab')->name('profile.tab.info');

    Route::group(['prefix' => 'update', 'middleware' => 'auth'], function() {
	    //
	    Route::post('/settings', 'ProfileController@update')->name('profile.update.settings');
	    Route::post('/avatar', 'ProfileController@update')->name('profile.update.avatar');
	    Route::post('/password', 'ProfileController@update')->name('profile.update.password');
	});
});