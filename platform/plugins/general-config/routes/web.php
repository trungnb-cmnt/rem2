<?php

Route::group(['namespace' => 'Botble\GeneralConfig\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'general-configs'], function () {

            Route::get('/', [
                'as' => 'general_config.list',
                'uses' => 'GeneralConfigController@getList',
            ]);

            Route::get('/create', [
                'as' => 'general_config.create',
                'uses' => 'GeneralConfigController@getCreate',
            ]);

            Route::post('/create', [
                'as' => 'general_config.create',
                'uses' => 'GeneralConfigController@postCreate',
            ]);

            Route::get('/edit/{id}', [
                'as' => 'general_config.edit',
                'uses' => 'GeneralConfigController@getEdit',
            ]);

            Route::post('/edit/{id}', [
                'as' => 'general_config.edit',
                'uses' => 'GeneralConfigController@postEdit',
            ]);

            Route::get('/delete/{id}', [
                'as' => 'general_config.delete',
                'uses' => 'GeneralConfigController@getDelete',
            ]);

            Route::post('/delete-many', [
                'as' => 'general_config.delete.many',
                'uses' => 'GeneralConfigController@postDeleteMany',
                'permission' => 'general_config.delete',
            ]);
        });
    });
    
});