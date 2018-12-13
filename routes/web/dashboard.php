<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    //
    Route::get('/', 'DashboardController@index')
        ->middleware('permission:dashboard.view');
        
    Route::get('/dashboard', 'DashboardController@index')
        ->middleware('permission:dashboard.view');
});