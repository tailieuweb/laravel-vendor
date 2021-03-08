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




    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Crawler\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage crawler
          |-----------------------------------------------------------------------
          | 1. List of crawler
          | 2. Edit crawler
          | 3. Delete crawler
          | 4. Add new crawler
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/crawlers', [
            'as' => 'crawlers',
            'uses' => 'CrawlerAdminController@index'
        ]);
        Route::get('admin/crawlers/list', [
            'as' => 'crawlers.list',
            'uses' => 'CrawlerAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawlers/edit', [
            'as' => 'crawlers.edit',
            'uses' => 'CrawlerAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawlers/copy', [
            'as' => 'crawlers.copy',
            'uses' => 'CrawlerAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawlers/edit', [
            'as' => 'crawlers.post',
            'uses' => 'CrawlerAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawlers/delete', [
            'as' => 'crawlers.delete',
            'uses' => 'CrawlerAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/crawlers/trash', [
            'as' => 'crawlers.trash',
            'uses' => 'CrawlerAdminController@trash'
        ]);

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

        /**
         * search
        */
        Route::get('admin/crawlers/search', [
                'as' => 'crawlers.search',
                'uses' => 'CrawlerAdminController@search'
        ]);



    });
});
