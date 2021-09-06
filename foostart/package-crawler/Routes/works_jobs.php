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
          | Manage Jobs
          |-----------------------------------------------------------------------
          | 1. List of jobs
          | 2. Edit job
          | 3. Delete job
          | 4. Add new job
          |
        */

        /**
         * list
         */
        Route::get('admin/crawler/works/jobs', [
            'as' => 'works.jobs.list',
            'uses' => 'JobsAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/works/jobs/edit', [
            'as' => 'works.jobs.edit',
            'uses' => 'JobsAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/works/jobs/copy', [
            'as' => 'works.jobs.copy',
            'uses' => 'JobsAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/works/jobs/edit', [
            'as' => 'works.jobs.post',
            'uses' => 'JobsAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/works/jobs/delete', [
            'as' => 'works.jobs.delete',
            'uses' => 'JobsAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/works/jobs/trash', [
            'as' => 'works.jobs.trash',
            'uses' => 'JobsAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/works/jobs/search', [
            'as' => 'works.jobs.search',
            'uses' => 'JobsAdminController@search'
        ]);

    });


});
