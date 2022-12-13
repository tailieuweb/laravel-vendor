<?php

use Illuminate\Session\TokenMismatchException;

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => [],
        'namespace' => 'Foostart\Front\Controllers',
            ], function () {
        /**
         * Copy block from root to source
         */
        //Copy blocks
        Route::get('/copy-blocks', [
            'as' => 'copy-block',
            'uses' => 'FrontController@copyBlocks'
        ]);
        //Install blocks
        Route::get('/install-blocks', [
            'as' => 'install-block',
            'uses' => 'HomeController@installBlocks'
        ]);
        Route::get('/convert', [
            'as' => 'convert',
            'uses' => 'HomeController@convertLESS2CSS'
        ]);
        //Demo
        Route::get('/demo', [
            'as' => 'demo',
            'uses' => 'FrontController@demo'
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
        ]);

        /**
         * Rules
         */
//        Route::get('/rules/{name}-{id}', [
//            'as' => 'rules',
//            'uses' => 'RulesController@index'
//        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**
         * Rule
         */
//        Route::get('/rule/{name}-{id}', [
//            'as' => 'rule',
//            'uses' => 'RuleController@index'
//        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);



        /**
         * Search
         */
//        Route::get('/search/{keyword?}', [
//            'as' => 'search',
//            'uses' => 'SearchController@index'
//        ])->where(['keyword' => '[a-zA-Z0-9-_]+']);

    });
});
