<?php

Route::group(['namespace' => 'Botble\Order\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'orders'], function () {

            Route::get('/', [
                'as' => 'order.list',
                'uses' => 'OrderController@getList',
            ]);

            Route::get('/create', [
                'as' => 'order.create',
                'uses' => 'OrderController@getCreate',
            ]);

            Route::post('/create', [
                'as' => 'order.create',
                'uses' => 'OrderController@postCreate',
            ]);

            Route::get('/edit/{id}', [
                'as' => 'order.edit',
                'uses' => 'OrderController@getEdit',
            ]);

            Route::post('/edit/{id}', [
                'as' => 'order.edit',
                'uses' => 'OrderController@postEdit',
            ]);

            Route::delete('/delete/{id}', [
                'as' => 'order.delete',
                'uses' => 'OrderController@getDelete',
            ]);

            Route::delete('/delete-many', [
                'as' => 'order.delete.many',
                'uses' => 'OrderController@postDeleteMany',
                'permission' => 'order.delete',
            ]);
        });
    });

});
