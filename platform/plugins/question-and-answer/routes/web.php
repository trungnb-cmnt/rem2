<?php

Route::group(['namespace' => 'Botble\QuestionAndAnswer\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'question-and-answers'], function () {

            Route::get('/', [
                'as' => 'question_and_answer.list',
                'uses' => 'QuestionAndAnswerController@getList',
            ]);

            Route::get('/create', [
                'as' => 'question_and_answer.create',
                'uses' => 'QuestionAndAnswerController@getCreate',
            ]);

            Route::post('/create', [
                'as' => 'question_and_answer.create',
                'uses' => 'QuestionAndAnswerController@postCreate',
            ]);

            Route::get('/edit/{id}', [
                'as' => 'question_and_answer.edit',
                'uses' => 'QuestionAndAnswerController@getEdit',
            ]);

            Route::post('/edit/{id}', [
                'as' => 'question_and_answer.edit',
                'uses' => 'QuestionAndAnswerController@postEdit',
            ]);

            Route::get('/delete/{id}', [
                'as' => 'question_and_answer.delete',
                'uses' => 'QuestionAndAnswerController@getDelete',
            ]);

            Route::post('/delete-many', [
                'as' => 'question_and_answer.delete.many',
                'uses' => 'QuestionAndAnswerController@postDeleteMany',
                'permission' => 'question_and_answer.delete',
            ]);
        });
    });
    
});