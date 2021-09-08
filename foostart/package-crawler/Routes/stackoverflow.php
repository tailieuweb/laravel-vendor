<?php

use Illuminate\Session\TokenMismatchException;

/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    /****************************************************************************
     * StackOverflow
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Crawler\Controllers\Admin\Sites\StackOverflow',
    ], function () {


        /*
          |-----------------------------------------------------------------------
          | Manage Tags of StackOverflow
          |-----------------------------------------------------------------------
          | 1. List of tags
          | 2. Edit tag
          | 3. Delete tag
          | 4. Add new tag
          |
        */

        /**
         * list
         */
        Route::get('admin/crawler/site/stackoverflow/tag', [
            'as' => 'crawler.stackoverflow.tag.list',
            'uses' => 'StackOverflowTagAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/site/stackoverflow/tag/edit', [
            'as' => 'crawler.stackoverflow.tag.edit',
            'uses' => 'StackOverflowTagAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/site/stackoverflow/tag/copy', [
            'as' => 'crawler.stackoverflow.tag.copy',
            'uses' => 'StackOverflowTagAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/site/stackoverflow/tag/edit', [
            'as' => 'crawler.stackoverflow.tag.post',
            'uses' => 'StackOverflowTagAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/site/stackoverflow/tag/delete', [
            'as' => 'crawler.stackoverflow.tag.delete',
            'uses' => 'StackOverflowTagAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/site/stackoverflow/tag/trash', [
            'as' => 'crawler.stackoverflow.tag.trash',
            'uses' => 'StackOverflowTagAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/site/stackoverflow/tag/search', [
            'as' => 'crawler.stackoverflow.tag.search',
            'uses' => 'StackOverflowTagAdminController@search'
        ]);


        /*
          |-----------------------------------------------------------------------
          | Manage Questions of StackOverflow
          |-----------------------------------------------------------------------
          | 1. List of questions
          | 2. Edit question
          | 3. Delete question
          | 4. Add new question
          |
        */

        /**
         * list
         */
        Route::get('admin/crawler/site/stackoverflow/questions', [
            'as' => 'crawler.stackoverflow.question.list',
            'uses' => 'StackOverflowQuestionAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/site/stackoverflow/question/edit', [
            'as' => 'crawler.stackoverflow.question.edit',
            'uses' => 'StackOverflowQuestionAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/site/stackoverflow/question/copy', [
            'as' => 'crawler.stackoverflow.question.copy',
            'uses' => 'StackOverflowQuestionAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/site/stackoverflow/question/edit', [
            'as' => 'stackoverflow.question.post',
            'uses' => 'StackOverflowQuestionAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/site/stackoverflow/question/delete', [
            'as' => 'crawler.stackoverflow.question.delete',
            'uses' => 'StackOverflowQuestionAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/site/stackoverflow/question/trash', [
            'as' => 'crawler.stackoverflow.question.trash',
            'uses' => 'StackOverflowQuestionAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/site/stackoverflow/question/search', [
            'as' => 'crawler.stackoverflow.question.search',
            'uses' => 'StackOverflowQuestionAdminController@search'
        ]);

        /*
          |-----------------------------------------------------------------------
          | Manage Answers of StackOverflow
          |-----------------------------------------------------------------------
          | 1. List of answers
          | 2. Edit answer
          | 3. Delete answer
          | 4. Add new answer
          |
        */

        /**
         * list
         */
        Route::get('admin/crawler/site/stackoverflow/answers', [
            'as' => 'crawler.stackoverflow.answer.list',
            'uses' => 'StackOverflowAnswerAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/site/stackoverflow/answer/edit', [
            'as' => 'crawler.stackoverflow.answer.edit',
            'uses' => 'StackOverflowAnswerAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/site/stackoverflow/answer/copy', [
            'as' => 'crawler.stackoverflow.answer.copy',
            'uses' => 'StackOverflowAnswerAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/site/stackoverflow/answer/edit', [
            'as' => 'crawler.stackoverflow.answer.post',
            'uses' => 'StackOverflowAnswerAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/site/stackoverflow/answer/delete', [
            'as' => 'crawler.stackoverflow.answer.delete',
            'uses' => 'StackOverflowAnswerAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/site/stackoverflow/answer/trash', [
            'as' => 'crawler.stackoverflow.answer.trash',
            'uses' => 'StackOverflowAnswerAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/site/stackoverflow/answer/search', [
            'as' => 'crawler.stackoverflow.answer.search',
            'uses' => 'StackOverflowAnswerAdminController@search'
        ]);

        /**
         * crawler
         */
        Route::get('admin/crawler/site/stackoverflow/tag/crawler', [
            'as' => 'crawler.stackoverflow.tag.crawler',
            'uses' => 'StackOverflowTagAdminController@crawler'
        ]);
        Route::get('admin/crawler/site/stackoverflow/question/crawler', [
            'as' => 'crawler.stackoverflow.question.crawler',
            'uses' => 'StackOverflowQuestionAdminController@crawler'
        ]);
        Route::get('admin/crawler/site/stackoverflow/answer/crawler', [
            'as' => 'crawler.stackoverflow.answer.crawler',
            'uses' => 'StackOverflowAnswerAdminController@crawler'
        ]);
    });//End Stackoverflow
});
