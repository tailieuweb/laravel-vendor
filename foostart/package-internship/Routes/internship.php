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
         * company
         */
        Route::get('admin/internship/edit_company', [
            'as' => 'internship.edit_company',
            'uses' => 'InternshipAdminController@editCompany'
        ]);

        //////////////////////////////////////////////////////
        /**
         * diary
         * list
         */
        Route::get('admin/internship/diary', [
            'as' => 'internship.diary',
            'uses' => 'InternshipDiaryAdminController@diary'
        ]);

        /**
         * diary
         * edit
         */
        Route::get('admin/internship/diary_edit', [
            'as' => 'internship.diary.edit',
            'uses' => 'InternshipDiaryAdminController@editDiary'
        ]);

        /**
         * diary
         * post
         */
        Route::post('admin/internship/diary_edit', [
            'as' => 'internship.diary.post',
            'uses' => 'InternshipDiaryAdminController@postDiary'
        ]);

        /**
         * diary
         * delete
         */
        Route::get('admin/internship/diary_delete', [
            'as' => 'internship.diary.delete',
            'uses' => 'InternshipDiaryAdminController@deleteDiary'
        ]);
        /////////////////////////////////////////////////////

        /**
         * post
         */
        Route::post('admin/internship/edit_company', [
            'as' => 'internship.post_company',
            'uses' => 'InternshipAdminController@postCompany'
        ]);

        /**
         * copy
         */
        Route::get('admin/internship/copy', [
            'as' => 'internship.copy',
            'uses' => 'InternshipAdminController@copy'
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
