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
            $router->get('view/{groupKey?}', 'TranslationsController@getView')->where('groupKey', '.*')
                ->middleware('permission:translations.groups');

            $router->get('/{groupKey?}', 'TranslationsController@index')->where('groupKey', '.*')
                ->name('admin.translations.index')
                ->middleware('permission:translations.view');
                
            $router->post('/groups/add', 'TranslationsController@postAddGroup')
                ->middleware('permission:translations.groups-store');

            $router->post('/add/{groupKey}', 'TranslationsController@postAdd')->where('groupKey', '.*')
                ->middleware('permission:translations.key-store');

            $router->post('/edit/{groupKey}', 'TranslationsController@postEdit')->where('groupKey', '.*')
                ->middleware('permission:translations.key-update');

            $router->post('/delete/{groupKey}/{translationKey}', 'TranslationsController@postDelete')->where('groupKey', '.*')
                ->middleware('permission:translations.key-store');

            $router->post('/import', 'TranslationsController@postImport')
                ->middleware('permission:translations.import');

            $router->post('/find', 'TranslationsController@postFind')
                ->middleware('permission:translations.import');
            
            $router->post('/locales/add', 'TranslationsController@postAddLocale');
            $router->post('/locales/remove', 'TranslationsController@postRemoveLocale');
            
            $router->post('/publish/{groupKey}', 'TranslationsController@postPublish')->where('groupKey', '.*')
                ->middleware('permission:translations.publish');
	    });
	    
    });
});
