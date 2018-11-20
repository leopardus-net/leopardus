<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');
});