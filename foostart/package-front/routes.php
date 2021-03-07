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
            'uses' => 'NewsController@listNews'
        ]);
        Route::get('/tin-tuc/{name}-{id}', [
            'as' => 'news.detail',
            'uses' => 'NewsController@detailNews'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**c
         * Personnel
         */
        Route::get('/giang-vien', [
            'as' => 'personnel.list',
            'uses' => 'PersonnelController@personnelList'
        ]);
        Route::get('/giang-vien/{name}-{id}', [
            'as' => 'personnel.detail',
            'uses' => 'PersonnelController@personnelDetail'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**
         * Student
         */
        Route::get('/sinh-vien', [
            'as' => 'student.list',
            'uses' => 'StudentController@studentList'
        ]);
        Route::get('/sinh-vien/{name}-{id}', [
            'as' => 'student.detail',
            'uses' => 'StudentController@studentDetail'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**
         * Thematic
         */
        Route::get('/chuyen-de', [
            'as' => 'thematic.list',
            'uses' => 'ThematicController@thematicList'
        ]);
        Route::get('/chuyen-de/{name}-{id}', [
            'as' => 'thematic.detail',
            'uses' => 'ThematicController@thematicDetail'
        ])->where(['name' => '[a-zA-Z0-9-_]+','id' => '[0-9]+']);

        /**
         * Contact
         */
        Route::get('/lien-he', [
            'as' => 'contact',
            'uses' => 'ContactController@index'
        ]);
        Route::post('/lien-he', [
            'as' => 'contact.post',
            'uses' => 'ContactController@contactPost'
        ]);
        /**
         * Intro
         */
        Route::get('/gioi-thieu', [
            'as' => 'intro',
            'uses' => 'IntroController@index'
        ]);
        /**
         * Admissions
         */
        Route::get('/tuyen-sinh', [
            'as' => 'admissions',
            'uses' => 'AdmissionsController@index'
        ]);

        /**
        * Brochure
        */
        Route::get('/brochure', [
            'as' => 'brochure',
            'uses' => 'BrochureController@index'
        ]);

        /**
         * Aao
         */
        Route::get('/dao-tao', [
            'as' => 'aao',
            'uses' => 'AaoController@index'
        ]);

    });
});
