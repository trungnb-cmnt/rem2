<?php

Route::group(['namespace' => 'Botble\About\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::resource('abouts', 'AboutController', ['names' => 'about']);

        Route::group(['prefix' => 'abouts'], function () {

            Route::delete('items/destroy', [
                'as'         => 'about.deletes',
                'uses'       => 'AboutController@deletes',
                'permission' => 'about.destroy',
            ]);
        });
    });

});
