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
        Route::get('admin/crawler/works/categories', [
            'as' => 'works.categories.list',
            'uses' => 'CategoriesAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/works/categories/edit', [
            'as' => 'works.categories.edit',
            'uses' => 'CategoriesAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/works/categories/copy', [
            'as' => 'works.categories.copy',
            'uses' => 'CategoriesAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/works/categories/edit', [
            'as' => 'works.categories.post',
            'uses' => 'CategoriesAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/works/categories/delete', [
            'as' => 'works.categories.delete',
            'uses' => 'CategoriesAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/works/categories/trash', [
            'as' => 'works.categories.trash',
            'uses' => 'CategoriesAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/works/categories/search', [
            'as' => 'works.categories.search',
            'uses' => 'CategoriesAdminController@search'
        ]);

    });


});
