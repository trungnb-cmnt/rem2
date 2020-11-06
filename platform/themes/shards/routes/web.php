<?php

Route::group(['namespace' => 'Theme\Shards\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('cart', [
            'uses' => 'CartController@index',
        ]);

        Route::post('/getDistrict', [
            'uses' => 'CartController@getDistrict',
        ]);

        Route::post('/getStates', [
            'uses' => 'CartController@getStates',
        ]);


        Route::post('/add-to-cart', [
            'uses' => 'CartController@addToCart'
        ]);

        Route::post('/update-cart', [
            'uses' => 'CartController@updateCart'
        ]);

        Route::post('/remove-cart-item', [
            'uses' => 'CartController@removeCart'
        ]);

        Route::post('/checkout', [
            'uses' => 'CartController@checkout'
        ]);
    });

});
