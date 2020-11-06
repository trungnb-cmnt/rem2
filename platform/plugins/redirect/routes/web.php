<?php

Route::group(['namespace' => 'Botble\Redirect\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'redirects'], function () {

            Route::get('/', [
                'as' => 'redirect.list',
                'uses' => 'RedirectController@getList',
            ]);

            Route::get('/create', [
                'as' => 'redirect.create',
                'uses' => 'RedirectController@getCreate',
            ]);

            Route::post('/create', [
                'as' => 'redirect.create',
                'uses' => 'RedirectController@postCreate',
            ]);

            Route::get('/edit/{id}', [
                'as' => 'redirect.edit',
                'uses' => 'RedirectController@getEdit',
            ]);

            Route::post('/edit/{id}', [
                'as' => 'redirect.edit',
                'uses' => 'RedirectController@postEdit',
            ]);

            Route::get('/delete/{id}', [
                'as' => 'redirect.delete',
                'uses' => 'RedirectController@getDelete',
            ]);

            Route::post('/delete-many', [
                'as' => 'redirect.delete.many',
                'uses' => 'RedirectController@postDeleteMany',
                'permission' => 'redirect.delete',
            ]);
        });
    });

});