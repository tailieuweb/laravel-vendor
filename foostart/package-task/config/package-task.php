<?php
return [

    //Number of worlds
    'length' => [
        'task_name' => [
            'min' => 10,
            'max' => 255,
        ],
        'task_overview' => [
            'min' => 10,
            'max' => 255,
        ],
        'task_description' => [
            'min' => 255,
            'max' => 0,//unlimit
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
    'load_from' => 'package-task::',

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
        'assigned' => 1,
        'canceled' => 2,
        'done' => 3,
        'declined' => 4,
        'inprogress' => 5,
        'pending' => 6,
        'list' => [
            1 => 'Assigned',
            2 => 'Canceled',
            3 => 'Done',
            4 => 'Declined',
            5 => 'In progress',
            6 => 'Pending',
        ],
        'color' => [
            1 => '#5bc0de',
            2  => '#a8aac2',
            3  => '#a8bbc2',
            4 => '#000000',
            5  => '#ef4832',
            6  => '#ef4522',
        ]
    ],
    'size' => [
        'small' => 1,
        'medium' => 2,
        'large' => 3,
        'list' => [
            1 => 'Small',
            2 => 'Medium',
            3 => 'Large'
        ],
        'color' => [
            1 => '#5bc0de',
            2  => '#a8aac2',
            3  => '#a8bbc2'
        ]
    ],
    'priority' => [
        'low' => 1,
        'medium' => 2,
        'high' => 3,
        'list' => [
            1 => 'Low',
            2 => 'Medium',
            3 => 'High'
        ],
        'color' => [
            1 => '#5bc0de',
            2  => '#a8aac2',
            3  => '#a8bbc2'
        ]
    ],

];
