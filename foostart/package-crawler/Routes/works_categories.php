<?php

use Illuminate\Session\TokenMismatchException;

/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {


    /****************************************************************************
     * Job
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
        'namespace' => 'Foostart\Crawler\Controllers\Admin\Works',
    ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage Categories
          |-----------------------------------------------------------------------
          | 1. List of categories
          | 2. Edit category
          | 3. Delete category
          | 4. Add new category
          |
        */

        /**
         * list
         */
        Route::get('admin/crawler/work/category', [
            'as' => 'crawler.work.category.list',
            'uses' => 'CategoriesAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/work/category/edit', [
            'as' => 'crawler.work.category.edit',
            'uses' => 'CategoriesAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/work/category/copy', [
            'as' => 'crawler.work.category.copy',
            'uses' => 'CategoriesAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/work/category/edit', [
            'as' => 'crawler.work.category.post',
            'uses' => 'CategoriesAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/work/category/delete', [
            'as' => 'crawler.work.category.delete',
            'uses' => 'CategoriesAdminController@delete'
        ]);
        /**
         * restore
         */
        Route::get('admin/crawler/work/category/restore', [
            'as' => 'crawler.work.category.restore',
            'uses' => 'CategoriesAdminController@restore'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/work/category/trash', [
            'as' => 'crawler.work.category.trash',
            'uses' => 'CategoriesAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/work/category/search', [
            'as' => 'crawler.work.category.search',
            'uses' => 'CategoriesAdminController@search'
        ]);

    });


});
