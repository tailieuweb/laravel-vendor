<?php

use Illuminate\Session\TokenMismatchException;

/**
 * USER
 */
Route::group(['middleware' => ['web', ], 'namespace' => 'Foostart\Crawler\Controllers\User', ], function () {
    /**
    * list
    */
   Route::post('crawler', [
       'as' => 'usercrawler.post',
       'uses' => 'CrawlerUserController@post'
   ]);
});


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {
    /**
     * sample
    */
    Route::get('crawlers/sample', [
        'as' => 'crawlers.sample',
        'uses' => 'Foostart\Crawler\Controllers\Admin\CrawlerAdminController@sample'
    ]);
    Route::post('crawlers/sample', [
        'as' => 'crawlers.sample',
        'uses' => 'Foostart\Crawler\Controllers\Admin\CrawlerAdminController@addSample'
    ]);


    /**
     * Common
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Crawler\Controllers\Admin',
        ], function () {

        /**
         * configs
        */
        Route::get('admin/crawlers/config', [
            'as' => 'crawlers.config',
            'uses' => 'CrawlerAdminController@config'
        ]);

        Route::post('admin/crawlers/config', [
            'as' => 'crawlers.config',
            'uses' => 'CrawlerAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/crawlers/lang', [
            'as' => 'crawlers.lang',
            'uses' => 'CrawlerAdminController@lang'
        ]);

        Route::post('admin/crawlers/lang', [
            'as' => 'crawlers.lang',
            'uses' => 'CrawlerAdminController@lang'
        ]);

    });

    /****************************************************************************
     * Site
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Crawler\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage sites
          |-----------------------------------------------------------------------
          | 1. List of sites
          | 2. Edit site
          | 3. Delete site
          | 4. Add new site
          |
        */

        /**
         * list
         */
        Route::get('admin/sites', [
            'as' => 'sites.list',
            'uses' => 'SiteAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/sites/edit', [
            'as' => 'sites.edit',
            'uses' => 'SiteAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/sites/copy', [
            'as' => 'sites.copy',
            'uses' => 'SiteAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/sites/edit', [
            'as' => 'sites.post',
            'uses' => 'SiteAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/sites/delete', [
            'as' => 'sites.delete',
            'uses' => 'SiteAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/sites/trash', [
            'as' => 'sites.trash',
            'uses' => 'SiteAdminController@trash'
        ]);

        /**
         * search
        */
        Route::get('admin/sites/search', [
                'as' => 'sites.search',
                'uses' => 'SiteAdminController@search'
        ]);

    });

    /****************************************************************************
     * Pattern
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
        'namespace' => 'Foostart\Crawler\Controllers\Admin',
    ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage patterns
          |-----------------------------------------------------------------------
          | 1. List of patterns
          | 2. Edit pattern
          | 3. Delete patterns
          | 4. Add new patterns
          |
        */

        /**
         * list
         */
        Route::get('admin/patterns', [
            'as' => 'patterns.list',
            'uses' => 'PatternAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/patterns/edit', [
            'as' => 'patterns.edit',
            'uses' => 'PatternAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/patterns/copy', [
            'as' => 'patterns.copy',
            'uses' => 'PatternAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/patterns/edit', [
            'as' => 'patterns.post',
            'uses' => 'PatternAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/patterns/delete', [
            'as' => 'patterns.delete',
            'uses' => 'PatternAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/patterns/trash', [
            'as' => 'patterns.trash',
            'uses' => 'PatternAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/patterns/search', [
            'as' => 'patterns.search',
            'uses' => 'PatternAdminController@search'
        ]);

    });//End pattern

    /****************************************************************************
     * StackOverflow
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Crawler\Controllers\Admin\Site\StackOverflow',
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
        Route::get('admin/sites/stackoverflow/tags', [
            'as' => 'stackoverflow_tag.list',
            'uses' => 'StackOverflowTagAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/sites/stackoverflow/tag/edit', [
            'as' => 'stackoverflow_tag.edit',
            'uses' => 'StackOverflowTagAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/sites/stackoverflow/tag/copy', [
            'as' => 'stackoverflow_tag.copy',
            'uses' => 'StackOverflowTagAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/sites/stackoverflow/tag/edit', [
            'as' => 'stackoverflow_tag.post',
            'uses' => 'StackOverflowTagAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/sites/stackoverflow/tag/delete', [
            'as' => 'stackoverflow_tag.delete',
            'uses' => 'StackOverflowTagAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/sites/stackoverflow/tag/trash', [
            'as' => 'stackoverflow_tag.trash',
            'uses' => 'StackOverflowTagAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/sites/stackoverflow/tag/search', [
            'as' => 'stackoverflow_tag.search',
            'uses' => 'StackOverflowTagAdminController@search'
        ]);

        /*
          |-----------------------------------------------------------------------
          | Manage Questions of StackOverflow
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
        Route::get('admin/sites/stackoverflow/questions', [
            'as' => 'stackoverflow_question.list',
            'uses' => 'StackOverflowQuestionAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/sites/stackoverflow/question/edit', [
            'as' => 'stackoverflow_question.edit',
            'uses' => 'StackOverflowQuestionAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/sites/stackoverflow/question/copy', [
            'as' => 'stackoverflow_question.copy',
            'uses' => 'StackOverflowQuestionAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/sites/stackoverflow/question/edit', [
            'as' => 'stackoverflow_question.post',
            'uses' => 'StackOverflowQuestionAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/sites/stackoverflow/question/delete', [
            'as' => 'stackoverflow_question.delete',
            'uses' => 'StackOverflowQuestionAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/sites/stackoverflow/question/trash', [
            'as' => 'stackoverflow_question.trash',
            'uses' => 'StackOverflowQuestionAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/sites/stackoverflow/question/search', [
            'as' => 'stackoverflow_question.search',
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
        Route::get('admin/sites/stackoverflow/answers', [
            'as' => 'stackoverflow_answer.list',
            'uses' => 'StackOverflowAnswerAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/sites/stackoverflow/answer/edit', [
            'as' => 'stackoverflow_answer.edit',
            'uses' => 'StackOverflowAnswerAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/sites/stackoverflow/answer/copy', [
            'as' => 'stackoverflow_answer.copy',
            'uses' => 'StackOverflowAnswerAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/sites/stackoverflow/answer/edit', [
            'as' => 'stackoverflow_answer.post',
            'uses' => 'StackOverflowAnswerAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/sites/stackoverflow/answer/delete', [
            'as' => 'stackoverflow_answer.delete',
            'uses' => 'StackOverflowAnswerAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/sites/stackoverflow/answer/trash', [
            'as' => 'stackoverflow_answer.trash',
            'uses' => 'StackOverflowAnswerAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/sites/stackoverflow/answer/search', [
            'as' => 'stackoverflow_answer.search',
            'uses' => 'StackOverflowAnswerAdminController@search'
        ]);
    });//End Stackoverflow


});
