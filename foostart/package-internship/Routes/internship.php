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
        'namespace' => 'Foostart\Internship\Controllers\Admin',
    ], function () {

        /**
         * configs
         */
        Route::get('admin/internship/config', [
            'as' => 'Internship.config',
            'uses' => 'InternshipAdminController@config'
        ]);

        Route::post('admin/internship/config', [
            'as' => 'internship.config',
            'uses' => 'InternshipAdminController@config'
        ]);

        /**
         * language
         */
        Route::get('admin/internship/lang', [
            'as' => 'internship.lang',
            'uses' => 'InternshipAdminController@lang'
        ]);

        Route::post('admin/internship/lang', [
            'as' => 'internship.lang',
            'uses' => 'InternshipAdminController@lang'
        ]);

    });

    /****************************************************************************
     * Internship
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
        'namespace' => 'Foostart\Internship\Controllers\Admin',
    ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage companies
          |-----------------------------------------------------------------------
          | 1. List of companies
          | 2. Edit internship
          | 3. Delete internship
          | 4. Add new internship
          |
        */

        /**
         * list
         */
        Route::get('admin/internship', [
            'as' => 'internship',
            'uses' => 'InternshipAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/internship/edit', [
            'as' => 'internship.edit',
            'uses' => 'InternshipAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/internship/copy', [
            'as' => 'internship.copy',
            'uses' => 'InternshipAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/internship/edit', [
            'as' => 'internship.post',
            'uses' => 'InternshipAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/internship/delete', [
            'as' => 'internship.delete',
            'uses' => 'InternshipAdminController@delete'
        ]);

        /**
         * restore
         */
        Route::get('admin/internship/restore', [
            'as' => 'internship.restore',
            'uses' => 'InternshipAdminController@restore'
        ]);

        /**
         * trash
         */
        Route::get('admin/internship/trash', [
            'as' => 'internship.trash',
            'uses' => 'InternshipAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/internship/search', [
            'as' => 'internship.search',
            'uses' => 'InternshipAdminController@search'
        ]);
    });
});
