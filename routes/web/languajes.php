<?php

Route::group(['prefix' => 'admin/settings', 'middleware' => 'auth'], function() {
    Route::group(['prefix' => 'languajes'], function() {
        Route::get('/', 'LanguajesController@index')->name('languajes.index');
	    Route::post('/store', 'LanguajesController@store')->name('languajes.store');
	    Route::get('/update/{id}', 'LanguajesController@modify')->name('languajes.modify');
	    Route::put('/update/{id}', 'LanguajesController@update')->name('languajes.update');
	    Route::delete('/destroy/{id}', 'LanguajesController@destroy')->name('languajes.destroy');
    });
});

