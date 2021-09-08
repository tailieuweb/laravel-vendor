<?php
return [

    //Number of worlds
    'length' => [
        'crawler_name' => [
            'min' => 10,
            'max' => 255,
        ],
        'crawler_description' => [
            'min' => 255,
            'max' => 0,//unlimit
        ],
        'crawler_status' => [
            'min' => 255,
            'max' => 0,//unlimit
        ],
        'crawler_title' => [
            'min' => 10,
            'max' => 255,
        ],
        'crawler_email' => [
            'min' => 10,
            'max' => 255,
        ],
        'crawler_message' => [
            'min' => 10,
            'max' => 255,
        ],
        'site_name' => [
            'min' => 3,
            'max' => 255,
        ],
        'site_description' => [
            'min' => 3,
            'max' => 255,//unlimit
        ],
        'pattern_name' => [
            'min' => 3,
            'max' => 255,
        ],
        'pattern_machine_name' => [
            'min' => 3,
            'max' => 255,
        ],
        //Stackoverflow tag
        'tag_name' => [
            'min' => 3,
            'max' => 255,
        ],
        'tag_url' => [
            'min' => 3,
            'max' => 255,
        ],
        //Stackoverflow question
        'question_name' => [
            'min' => 3,
            'max' => 255,
        ],
        'question_url' => [
            'min' => 3,
            'max' => 255,
        ],
        'question_description' => [
            'min' => 3,
            'max' => 0,//Unlimit
        ],
        //Stackoverflow answer
        'answer_url_user' => [
            'min' => 3,
            'max' => 255,
        ],
        'answer_description' => [
            'min' => 3,
            'max' => 255,
        ],

        //Works Jobs
        'job_name' => [
            'min' => 3,
            'max' => 255,
        ],
        'job_description' => [
            'min' => 3,
            'max' => 255,
        ],

        //Works Categories
        'category_name' => [
            'min' => 3,
            'max' => 255,
        ],
    ],
    'per_page' => 1,

    /*
    |-----------------------------------------------------------------------
    | ENVIRONMENT
    |-----------------------------------------------------------------------
    | 0: Development
    | 1: Production
    |
    */
    'env' => 0,
    'load_from' => 'package-crawler::',

    /*
    |-----------------------------------------------------------------------
    | LANGUAGES
    |-----------------------------------------------------------------------
    | vi
    | en
    |
    */
    'langs' => [
        'en' => 'English',
        'vi' => 'Vietnam'
    ],


    /*
    |-----------------------------------------------------------------------
    | Permissions
    |-----------------------------------------------------------------------
    | List
    | Edit
    | Add
    | Select
    |
    */
    'permissions' => [
        'list_all' => ['_superadmin', '_user-editor'],
        'list_by_context' => [],
        'edit' => ['_superadmin', '_user-editor'],
        'add' => ['_superadmin', '_user-editor'],
        'delete' => ['_superadmin', '_user-editor'],
    ],




     /*
      |--------------------------------------------------------------------------
      | ITEM STATUS
      |--------------------------------------------------------------------------
      | @public = 99
      | @in_trash = 55 delete from list
      | @draft = 11 auto save
      | @unpublish = 33
     */
    'status' => [
        'list' => [
            99 => 'Publish',
            33 => 'Unpublish',
            55 => 'In trash',
            11 => 'Draft',
        ],
        'color' => [
            11 => '#ef4832',
            33 => '#000000',
            55 => '#a8aac2',
            99 => '#5bc0de'
        ]
        ],
    /*
     |--------------------------------------------------------------------------
     | Crawler
     |--------------------------------------------------------------------------
     | @public = 99
     | @in_trash = 55 delete from list
     | @draft = 11 auto save
     | @unpublish = 33
    */

    'crawler' => [
        'url_tags' => 'https://stackoverflow.com/tags',
    ]
];
