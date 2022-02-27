<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see'],
                  'namespace' => 'Foostart\Task\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage task
          |-----------------------------------------------------------------------
          | 1. List of task
          | 2. Edit task
          | 3. Delete task
          | 4. Add new task
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/task', [
            'as' => 'task.list',
            'uses' => 'TaskAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/task/edit', [
            'as' => 'task.edit',
            'uses' => 'TaskAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/task/copy', [
            'as' => 'task.copy',
            'uses' => 'TaskAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/task/edit', [
            'as' => 'task.post',
            'uses' => 'TaskAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/task/delete', [
            'as' => 'task.delete',
            'uses' => 'TaskAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/task/trash', [
            'as' => 'task.trash',
            'uses' => 'TaskAdminController@trash'
        ]);

        /**
         * configs
        */
        Route::get('admin/task/config', [
            'as' => 'task.config',
            'uses' => 'TaskAdminController@config'
        ]);

        Route::post('admin/task/config', [
            'as' => 'task.config',
            'uses' => 'TaskAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/task/lang', [
            'as' => 'task.lang',
            'uses' => 'TaskAdminController@lang'
        ]);

        Route::post('admin/task/lang', [
            'as' => 'task.lang',
            'uses' => 'TaskAdminController@lang'
        ]);

    });
});
