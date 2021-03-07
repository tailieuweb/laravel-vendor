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
        133,
        134,
        135,
        136,
        137,
        138,
        139,
        140,
        141,
        142,
        143,
        144,
        146,
        147,
        151,
        152,
        153,
        154,
        155,
        157,
        158,
        161,
        162,
        163,
        164,
        165,
        170,
        171,
        172,
        173,
        174,
        175,
        176,
        177,
        178,
        179,
    ],


    /*
      |-----------------------------------------------------------------------
      | List of configs on page
      |-----------------------------------------------------------------------
      | 1-Home page
      | 2-News list page
      | 3-News detail page
      | 4-Personnel list page
      | 5-Personnel detail page
      | 6-Student list page
      | 7-Student detail page
      | 8-Thematic list page
      | 9-Thematic detail page
      | 10-Contact page
      | 11-Other page page
     */
    'page_config' => [

        /**
         * | 1-Home page
         */
        'home' => [
            'ids' => [
                133,
                134,
                136,
                137,
                138,
                139,
                140,
                141,
                142,
                177,
                178,
            ],
            'libs' => [
               134 => [
                   'js' => [
                        'swiper.min',
                    ],
                    'css' => [
                        'swiper.min',
                    ]
               ],
               141 => [
                   'js' => [
                        'ekko-lightbox-min',
                    ],
                    'css' => [
                    ]
               ]
            ]
        ],//| 1-Home page


        /**
         * | 2-News list page
         */
        'news_list' => [
            'ids' => [
                133,
                137,
                143,
                144,
                152,
                153,
                171,
                177,
            ],
            'libs' => [
            ]
        ],//| 2-News list page


        /**
         * | 3-News detail page
         */
        'news_detail' => [
            'ids' => [
                133,
                136,
                143,
                152,
                153,
                155,
                158,
                171,
                177,
                179,
            ],
            'libs' => [
            ]
        ],//| 3-News detail page


        /**
         * | 4-Personnel list page
         */
        'personnel_list' => [
            'ids' => [
                133,
                146,
                147,
                152,
                153,
                177,
            ],
            'libs' => [
            ]
        ],//| 4-Personnel list page

        /**
         * | 5-Personnel detail page
         */
        'personnel_detail' => [
            'ids' => [
                133,
                135,
                147,
                152,
                153,
                155,
                177,

            ],
            'libs' => [
            ]
        ],//| 5-Personnel detail page

        /**
         * | 6-Student list page
         */
        'student_list' => [
            'ids' => [
                133,
                137,
                138,
                143,
                144,
                151,
                153,
                154,
                155,
                157,
                158,
                177,

            ],
            'libs' => [
            ]
        ],//| 6-Student list page

        /**
         * | 7-Student detail page
         */
        'student_detail' => [
            'ids' => [
                133,
                136,
                143,
                152,
                153,
                155,
                158,
                171,
                177,
                179,
            ],
            'libs' => [
            ]
        ],//| 7-Student detail page

        /**
         * | 8-Thematic list page
         */
        'thematic_list' => [
            'ids' => [
                133,
                143,
                158,
                170,
                177,

            ],
            'libs' => [
            ]
        ],//| 8-Thematic list page

        /**
         * | 9-Thematic detail page
         */
        'thematic_detail' => [
            'ids' => [
                133,
                143,
                152,
                153,
                155,
                158,
                171,
                177,
                179,
            ],
            'libs' => [
            ]
        ],//| 9-Thematic detail page

        /**
         * | 10-Contact page
         */
        'contact' => [
            'ids' => [
                133,
                163,
                164,
                177,
            ],
            'libs' => [
            ]
        ],//| 10-Contact page

        /**
         * | 11-Intro
         */
        'intro' => [
            'ids' => [
                133,
                136,
                137,
                165,
                176,
                177,
            ],
            'libs' => [
            ]
        ],//| 11-Intro

        /**
         * | 12-Admissions
         */
        'admissions' => [
            'ids' => [
                133,
                162,
                172,
                177,
            ],
            'libs' => [
                172 => [
                    'css' => [
                        'Cube_Animation',
                    ]
                ],
            ]
        ],//| 12-Admissions

        /**
         * | 13-Brochure
         */
        'brochure' => [
            'ids' => [
                133,
                173,
                177,
            ],
            'libs' => [
                173 => [
                    'js' => [
                        'turn.min',
                    ]
                ],
            ]
        ],//| 13-Brochure

        /**
         * | 14-Aao
         */
        'aao' => [
            'ids' => [
                133,
                161,
                177
            ],
            'libs' => [
            ]
        ],//| 14-Aao
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
        'source_blocks' => 'D:\1-github-workspace\1-tailieuweb\2-project-fit\1-templates\1-blocks',
    ],
];
