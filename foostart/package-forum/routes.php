<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('forum', [
    'as' => 'forum',
    'uses' => 'Foostart\Forum\Controllers\Front\ForumFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
        'namespace' => 'Foostart\Forum\Controllers\Admin',
    ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage post
          |-----------------------------------------------------------------------
          | 1. List of q&a items
          | 2. Edit post
          | 3. Delete post
          | 4. Add new post
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/forums', [
            'as' => 'forums.list',
            'uses' => 'ForumAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/forums/edit', [
            'as' => 'forums.edit',
            'uses' => 'ForumAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/forums/copy', [
            'as' => 'forums.copy',
            'uses' => 'ForumAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/forums/edit', [
            'as' => 'forums.post',
            'uses' => 'ForumAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/forums/delete', [
            'as' => 'forums.delete',
            'uses' => 'ForumAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/forums/trash', [
            'as' => 'forums.trash',
            'uses' => 'ForumAdminController@trash'
        ]);

        /**
         * configs
         */
        Route::get('admin/forums/config', [
            'as' => 'forums.configGet',
            'uses' => 'ForumAdminController@config'
        ]);

        Route::post('admin/forums/config', [
            'as' => 'forums.configPost',
            'uses' => 'ForumAdminController@config'
        ]);

        /**
         * language
         */
        Route::get('admin/forums/lang', [
            'as' => 'forums.langGet',
            'uses' => 'ForumAdminController@lang'
        ]);

        Route::post('admin/forums/lang', [
            'as' => 'forums.langPost',
            'uses' => 'ForumAdminController@lang'
        ]);

    });
});
