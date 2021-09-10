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
        Route::get('admin/crawler/work/job', [
            'as' => 'crawler.work.job.list',
            'uses' => 'JobsAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/crawler/work/job/edit', [
            'as' => 'crawler.work.job.edit',
            'uses' => 'JobsAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/crawler/work/job/copy', [
            'as' => 'crawler.work.job.copy',
            'uses' => 'JobsAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/crawler/work/job/edit', [
            'as' => 'crawler.work.job.post',
            'uses' => 'JobsAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/crawler/work/job/delete', [
            'as' => 'crawler.work.job.delete',
            'uses' => 'JobsAdminController@delete'
        ]);
        /**
         * restore
         */
        Route::get('admin/crawler/work/job/restore', [
            'as' => 'crawler.work.job.restore',
            'uses' => 'JobsAdminController@restore'
        ]);

        /**
         * trash
         */
        Route::get('admin/crawler/work/job/trash', [
            'as' => 'crawler.work.job.trash',
            'uses' => 'JobsAdminController@trash'
        ]);

        /**
         * search
         */
        Route::get('admin/crawler/work/job/search', [
            'as' => 'crawler.work.job.search',
            'uses' => 'JobsAdminController@search'
        ]);

    });


});
