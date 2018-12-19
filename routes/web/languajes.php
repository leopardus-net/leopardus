<?php

Route::group(['prefix' => 'admin/settings', 'middleware' => 'auth'], function() {
    Route::group(['prefix' => 'languajes'], function() {
		Route::get('/', 'LanguajesController@index')
			->name('languajes.index')
			->middleware('permission:languaje.view');

		Route::post('/store', 'LanguajesController@store')
			->name('languajes.store')
			->middleware('permission:languaje.store');

		Route::get('/update/{id}', 'LanguajesController@modify')
			->name('languajes.modify')
			->middleware('permission:languaje.update');

		Route::put('/update/{id}', 'LanguajesController@update')
			->name('languajes.update')
			->middleware('permission:languaje.update');

		Route::delete('/destroy/{id}', 'LanguajesController@destroy')
			->name('languajes.destroy')
			->middleware('permission:languaje.delete');
    });
});

