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
        'namespace' => 'Foostart\Courses\Controllers\Admin',
    ], function () {

        /**
         * configs
         */
        Route::get('admin/courses/config', [
            'as' => 'course.config',
            'uses' => 'CourseAdminController@config'
        ]);

        Route::post('admin/courses/config', [
            'as' => 'course.config',
            'uses' => 'CourseAdminController@config'
        ]);

        /**
         * language
         */
        Route::get('admin/courses/lang', [
            'as' => 'course.lang',
            'uses' => 'CourseAdminController@lang'
        ]);

        Route::post('admin/courses/lang', [
            'as' => 'course.lang',
            'uses' => 'CourseAdminController@lang'
        ]);

    });

    /****************************************************************************
     * Course
     */
    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
        'namespace' => 'Foostart\Courses\Controllers\Admin',
    ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage companies
          |-----------------------------------------------------------------------
          | 1. List of companies
          | 2. Edit courses
          | 3. Delete courses
          | 4. Add new courses
          |
        */

        /**
         * list
         */
        Route::get('admin/courses', [
            'as' => 'course',
            'uses' => 'CourseAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/courses/edit', [
            'as' => 'course.edit',
            'uses' => 'CourseAdminController@edit'
        ]);

        /**
         * class
         */
        Route::get('admin/courses/class/', [
            'as' => 'course.edit',
            'uses' => 'CourseAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/courses/copy', [
            'as' => 'course.copy',
            'uses' => 'CourseAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/courses/edit', [
            'as' => 'course.post',
            'uses' => 'CourseAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/courses/delete', [
            'as' => 'course.delete',
            'uses' => 'CourseAdminController@delete'
        ]);

        /**
         * restore
         */
        Route::get('admin/courses/restore', [
            'as' => 'course.restore',
            'uses' => 'CourseAdminController@restore'
        ]);
        /**
         * raw
         */
        Route::get('admin/courses/raw', [
            'as' => 'course.raw',
            'uses' => 'CourseAdminController@raw'
        ]);
        /**
         * view
         */
        Route::get('admin/courses/view', [
            'as' => 'course.view',
            'uses' => 'CourseAdminController@view'
        ]);
        /**
         * trash
         */
        Route::get('admin/courses/trash', [
            'as' => 'course.trash',
            'uses' => 'CourseAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/courses/search', [
            'as' => 'course.search',
            'uses' => 'CourseAdminController@search'
        ]);
    });
});
