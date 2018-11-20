<?php
/* 
	IDEA: Con esas etiquetas, puedo saber donde y cuando termina un grupo
	de esa forma puedo escribir otros grupos dentro de otros grupos sin 
	provocar bugs en el codigo.
*/

/* @group('admin') */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    /* @start('admin')
    
    /* @group('settings') */
    Route::group(['prefix' => 'settings'], function() {
        /* @start('settings') */

        /* @group('translations') */
	    Route::group(['prefix' => 'translations'], function($router) {
	        /* @start('translations') */
	        $router->get('view/{groupKey?}', 'TranslationsController@getView')->where('groupKey', '.*');
            $router->get('/{groupKey?}', 'TranslationsController@index')->where('groupKey', '.*');
            $router->post('/add/{groupKey}', 'TranslationsController@postAdd')->where('groupKey', '.*');
            $router->post('/edit/{groupKey}', 'TranslationsController@postEdit')->where('groupKey', '.*');
            $router->post('/groups/add', 'TranslationsController@postAddGroup');
            $router->post('/delete/{groupKey}/{translationKey}', 'TranslationsController@postDelete')->where('groupKey', '.*');
            $router->post('/import', 'TranslationsController@postImport');
            $router->post('/find', 'TranslationsController@postFind');
            $router->post('/locales/add', 'TranslationsController@postAddLocale');
            $router->post('/locales/remove', 'TranslationsController@postRemoveLocale');
            $router->post('/publish/{groupKey}', 'TranslationsController@postPublish')->where('groupKey', '.*');
	    });
	    
    });
});
