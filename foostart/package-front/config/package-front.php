<?php

return [

    /*
      |-----------------------------------------------------------------------
      | Block ID
      |-----------------------------------------------------------------------
      | List of block ids that used in all pages
      |
     */
    'temp_ids' => [

    ],
    'block_ids' => [
        7,
        60,
        73,
        129,
        261,
        282,
        859,
        1100,
        1222,
        1272,
        2034,
        2038
    ],


    /*
      |-----------------------------------------------------------------------
      | List of configs on page
      |-----------------------------------------------------------------------
      |
     */
    'page_config' => [

        //home page
        'home' => [
            'ids' => [
                2034,
                2038,
                261,
                1222,
                859,
                7
            ],
            'libs' => [
                2038 => [
                    'js' => [
                        'swiper.min'
                    ]
                ],
            ]
        ], //home page


        //rule page
        'rule' => [
            'ids' => [
                2034,
                60,
                7,
                129,
            ],
            'libs' => [
            ]
        ], //rule page


        //rules page
        'rules' => [
            'ids' => [
                2034,
                129,
                7,
            ],
            'libs' => [
            ]
        ], //checklist page


        //contact page
        'contact' => [
            'ids' => [
                2034,
                282,
                7,
            ],
            'libs' => [
            ]
        ], //contact page

    ],




    /*
    |-----------------------------------------------------------------------
    | ASSETS LIB
    |-----------------------------------------------------------------------
    | Bootstrap
    | jQuery
    |
    |
    */
    'assets_lib' => [
        'css' => [
            'packages/foostart/package-front/css/bootstrap-3.3.6.min.css',
            'packages/foostart/package-front/css/font-awesome-4.7.0.min.css',
            'packages/foostart/package-front/css/styles-1.0.0.css',
        ],
        'js' => [
            'packages/foostart/package-front/js/jquery-2.1.4.min.js',
            'packages/foostart/package-front/js/bootstrap3.3.6.min.js',
        ]
    ],





    /* CACHE
    |-----------------------------------------------------------------------
    |
    |-----------------------------------------------------------------------
    | Time
    |
    |
    |
    */
    'cache' => [
        'status' => FALSE,
        'time_comment' => 60,//minutes
    ],





    /* DIRECTORY
    |-----------------------------------------------------------------------
    |
    |-----------------------------------------------------------------------
    | Dir block
    |
    |
    |
    */
    'dir' => [
        'status' => TRUE,
        'root_source_blocks' => 'E:\dev\1-blocks\1-sources',
        'source_blocks' => 'K:\dev\5-theptinhuy.com\trunk\public\templates\blocks',
    ],
];
