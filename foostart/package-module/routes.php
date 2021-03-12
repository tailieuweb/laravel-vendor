<?php

use Illuminate\Session\TokenMismatchException;
use Foostart\Module\Controllers\Admin;
/**
 * USER
 */
Route::group(['middleware' => ['web', ], 'namespace' => 'Foostart\Module\Controllers\User', ], function () {
    /**
    * list
    */
   Route::post('module', [
       'as' => 'usermodule.post',
       'uses' => 'ModuleUserController@post'
   ]);
});


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {
    /**
     * sample
    */
    Route::get('modules/sample', [
        'as' => 'modules.sample',
        'uses' => 'Foostart\Module\Controllers\Admin\ModuleAdminController@sample'
    ]);
    Route::post('modules/sample', [
        'as' => 'modules.sample',
        'uses' => 'Foostart\Module\Controllers\Admin\ModuleAdminController@addSample'
    ]);




    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Module\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage module
          |-----------------------------------------------------------------------
          | 1. List of module
          | 2. Edit module
          | 3. Delete module
          | 4. Add new module
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/modules', [
            'as' => 'modules',
            'uses' => 'ModuleAdminController@index'
        ]);
        Route::get('admin/modules/list', [
            'as' => 'modules.list',
            'uses' => 'ModuleAdminController@index'
        ]);

        /**
         * view
         */
        Route::get('admin/modules/view', [
            'as' => 'modules.view',
            'uses' => 'ModuleAdminController@view'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/modules/edit', [
            'as' => 'modules.edit',
            'uses' => 'ModuleAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/modules/copy', [
            'as' => 'modules.copy',
            'uses' => 'ModuleAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/modules/edit', [
            'as' => 'modules.post',
            'uses' => 'ModuleAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/modules/delete', [
            'as' => 'modules.delete',
            'uses' => 'ModuleAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/modules/trash', [
            'as' => 'modules.trash',
            'uses' => 'ModuleAdminController@trash'
        ]);

        /**
         * configs
        */
        Route::get('admin/modules/config', [
            'as' => 'modules.config',
            'uses' => 'ModuleAdminController@config'
        ]);

        Route::post('admin/modules/config', [
            'as' => 'modules.config',
            'uses' => 'ModuleAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/modules/lang', [
            'as' => 'modules.lang',
            'uses' => 'ModuleAdminController@lang'
        ]);

        Route::post('admin/modules/lang', [
            'as' => 'modules.lang',
            'uses' => 'ModuleAdminController@lang'
        ]);

        /**
         * search
        */
        Route::get('admin/modules/search', [
                'as' => 'modules.search',
                'uses' => 'ModuleAdminController@search'
        ]);



    });
});

/**
 * view
 */
Route::group(['middleware' => ['web'], 'namespace' => 'Foostart\Module\Controllers\Admin'],
    function () {
    /**
     * list
     */
        Route::get('modules/view', [
            'as' => 'modules.viewfront',
            'uses' => 'ModuleAdminController@viewfront'
        ]);
});

