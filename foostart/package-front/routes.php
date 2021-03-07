<?php

use Illuminate\Session\TokenMismatchException;

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => [],
        'namespace' => 'Foostart\Front\Controllers',
            ], function () {

        $route_exceptions = [
            'login',
            'laravel-filemanager',
        ];
        $temp = implode('|', $route_exceptions);

        /**
         * Copy block from root to source
         */
        //Copy blocks
        Route::get('/copy-blocks', [
            'as' => 'copy-block',
            'uses' => 'InstallController@copyBlocks'
        ]);
        //Install blocks
        Route::get('/install-blocks', [
            'as' => 'install-block',
            'uses' => 'InstallController@installBlocks'
        ]);
        Route::get('/convert', [
            'as' => 'convert',
            'uses' => 'InstallController@convertLESS2CSS'
        ]);
        //Demo
        Route::get('/demo', [
            'as' => 'demo',
            'uses' => 'InstallController@demo'
        ]);

    });
});


/*
|-----------------------------------------------------------------------
| MAIN PAGES
|-----------------------------------------------------------------------
| 01. Home
| 02. Rules
| 03. Rule
|
*/
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => [],
        'namespace' => 'Foostart\Front\Controllers',
            ], function () {

        $route_exceptions = [
            'login',
            'laravel-filemanager',
        ];
        $temp = implode('|', $route_exceptions);

        /**
         * Home
         */
        Route::get('/', [
            'as' => 'home',
            'uses' => 'HomeController@index'
        ]); Route::get('/trang-chu', [
            'as' => 'home',
            'uses' => 'HomeController@index'
        ]);

        /**
         * News
         */
        Route::get('/tin-tuc', [
            'as' => 'news.list',
            'uses' => 'PostUserController@listNews'
        ]);
        Route::get('/tin-tuc/{name}-{id}', [
            'as' => 'news.detail',
            'uses' => 'PostUserController@detailNews'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**c
         * Personnel
         */
        Route::get('/nhan-su', [
            'as' => 'personnel.list',
            'uses' => 'PostUserController@listPersonnel'
        ]);
        Route::get('/nhan-su/{name}-{id}', [
            'as' => 'personnel.detail',
            'uses' => 'PostUserController@detailPersonnel'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**
         * Student
         */
        Route::get('/sinh-vien', [
            'as' => 'student.list',
            'uses' => 'PostUserController@listStudent'
        ]);
        Route::get('/sinh-vien/{name}-{id}', [
            'as' => 'student.detail',
            'uses' => 'PostUserController@detailStudent'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**
         * Thematic
         */
        Route::get('/chuyen-de', [
            'as' => 'thematic.list',
            'uses' => 'PostUserController@listThematic'
        ]);
        Route::get('/chuyen-de/{name}-{id}', [
            'as' => 'thematic.detail',
            'uses' => 'PostUserController@detailThematic'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);




        /**
         * Search
         */
        Route::get('/search/{keyword?}', [
            'as' => 'search',
            'uses' => 'SearchController@index'
        ])->where(['keyword' => '[a-zA-Z0-9-_]+']);

    });
});
