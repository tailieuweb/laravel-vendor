<?php

use Illuminate\Session\TokenMismatchException;

/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {


    /**
     * Common
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
        'namespace' => 'Foostart\Crawler\Controllers\Admin',
    ], function () {

        /**
         * configs
         */
        Route::get('admin/crawler/config', [
            'as' => 'crawler.config',
            'uses' => 'CrawlerAdminController@config'
        ]);

        Route::post('admin/crawler/config', [
            'as' => 'crawler.config',
            'uses' => 'CrawlerAdminController@config'
        ]);

        /**
         * language
         */
        Route::get('admin/crawler/lang', [
            'as' => 'crawler.lang',
            'uses' => 'CrawlerAdminController@lang'
        ]);

        Route::post('admin/crawler/lang', [
            'as' => 'crawler.lang',
            'uses' => 'CrawlerAdminController@lang'
        ]);

    });

    /****************************************************************************
     * Sites
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
        Route::get('admin/crawler/site', [
            'as' => 'crawler.site.list',
            'uses' => 'SiteAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/site/edit', [
            'as' => 'crawler.site.edit',
            'uses' => 'SiteAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/site/copy', [
            'as' => 'crawler.site.copy',
            'uses' => 'SiteAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/site/edit', [
            'as' => 'crawler.site.post',
            'uses' => 'SiteAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/site/delete', [
            'as' => 'crawler.site.delete',
            'uses' => 'SiteAdminController@delete'
        ]);

        /**
         * restore
         */
        Route::get('admin/crawler/site/restore', [
            'as' => 'crawler.site.restore',
            'uses' => 'SiteAdminController@restore'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/site/trash', [
            'as' => 'crawler.site.trash',
            'uses' => 'SiteAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/site/search', [
            'as' => 'crawler.site.search',
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
        Route::get('admin/crawler/pattern', [
            'as' => 'crawler.pattern.list',
            'uses' => 'PatternAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/pattern/edit', [
            'as' => 'crawler.pattern.edit',
            'uses' => 'PatternAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/pattern/copy', [
            'as' => 'crawler.pattern.copy',
            'uses' => 'PatternAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/pattern/edit', [
            'as' => 'crawler.pattern.post',
            'uses' => 'PatternAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/pattern/delete', [
            'as' => 'crawler.pattern.delete',
            'uses' => 'PatternAdminController@delete'
        ]);

        /**
         * restore
         */
        Route::get('admin/crawler/pattern/restore', [
            'as' => 'crawler.pattern.restore',
            'uses' => 'PatternAdminController@restore'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/pattern/trash', [
            'as' => 'crawler.pattern.trash',
            'uses' => 'PatternAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/pattern/search', [
            'as' => 'crawler.pattern.search',
            'uses' => 'PatternAdminController@search'
        ]);

    });//End pattern
});
