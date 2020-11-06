<?php

Route::group(['namespace' => 'Botble\Catalog\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'catalog/products'], function () {
            Route::get('', [
                'as'   => 'catalog_products.list',
                'uses' => 'ProductController@getList',
            ]);

            Route::get('create', [
                'as'   => 'catalog_products.create',
                'uses' => 'ProductController@getCreate',
            ]);

            Route::post('create', [
                'as'   => 'catalog_products.create',
                'uses' => 'ProductController@postCreate',
            ]);

            Route::get('edit/{id}', [
                'as'   => 'catalog_products.edit',
                'uses' => 'ProductController@getEdit',
            ]);

            Route::post('edit/{id}', [
                'as'   => 'catalog_products.edit',
                'uses' => 'ProductController@postEdit',
            ]);

            Route::delete('delete/{id}', [
                'as'   => 'catalog_products.delete',
                'uses' => 'ProductController@getDelete',
            ]);

            Route::delete('delete-many', [
                'as'         => 'catalog_products.delete.many',
                'uses'       => 'ProductController@postDeleteMany',
                'permission' => 'catalog_products.delete',
            ]);

            Route::get('widgets/recent-catalog.products', [
                'as'         => 'catalog_products.widget.recent-catalog.products',
                'uses'       => 'ProductController@getWidgetRecentProducts',
                'permission' => 'dashboard.index',
            ]);
        });

        Route::group(['prefix' => 'catalog/categories'], function () {
            Route::get('', [
                'as'   => 'catalog_categories.list',
                'uses' => 'CategoryController@getList',
            ]);

            Route::get('create', [
                'as'   => 'catalog_categories.create',
                'uses' => 'CategoryController@getCreate',
            ]);

            Route::post('create', [
                'as'   => 'catalog_categories.create',
                'uses' => 'CategoryController@postCreate',
            ]);

            Route::get('edit/{id}', [
                'as'   => 'catalog_categories.edit',
                'uses' => 'CategoryController@getEdit',
            ]);

            Route::post('edit/{id}', [
                'as'   => 'catalog_categories.edit',
                'uses' => 'CategoryController@postEdit',
            ]);

            Route::delete('delete/{id}', [
                'as'   => 'catalog_categories.delete',
                'uses' => 'CategoryController@getDelete',
            ]);

            Route::delete('delete-many', [
                'as'         => 'catalog_categories.delete.many',
                'uses'       => 'CategoryController@postDeleteMany',
                'permission' => 'catalog_categories.delete',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
            Route::get('catalog/search', [
                'as'   => 'catalog.search',
                'uses' => 'PublicController@getSearch',
            ]);
        });
    }
});
