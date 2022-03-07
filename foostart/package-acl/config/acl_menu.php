<?php

$admin = '_superadmin';

$permissions = [
    'categories' => [
        'all' => '_category-editor',
        'list' => '_category-list',
        'edit' => '_category-edit',
        'delete' => '_category-delete',
        'add' => '_category-add',
        'external' => '_external',
    ]
];

return [
    /*
    |--------------------------------------------------------------------------
    | Admin panel menu items
    |--------------------------------------------------------------------------
    |
    | Here you can edit the items to show in the admin menu(on top of the page)
    |
    */
    "list" => [


        /*
        |-----------------------------------------------------------------------
        | Admin permissions
        |-----------------------------------------------------------------------
        | 1. Users page
        | 2. Groups page
        | 3. Permissions page
        | 4. Categories
        |
        */


        //Users page
        [
            "name" => "acl-admin.menu.users",
            "route" => "users",
            "link" => '/admin/users',
            "permissions" => [$admin, '_user-editor', '_user-leader'],
            "skip_permissions" => ["users.selfprofile.edit",
                    "users.profile.edit",
                    "users.profile.addfield",
                    "users.profile.deletefield",
                    "users.profile.changeselfavatar",
            ]
        ],


        //Groups page
        [
            "name" => "acl-admin.menu.groups",
            "route" => "groups",
            "link" => '/admin/groups',
            "permissions" => [$admin, "_group-editor"]
        ],


        //Permissions page
        [
            "name" => "acl-admin.menu.permissions",
            "route" => "permissions",
            "link" => '/admin/permissions',
            "permissions" => [$admin, "_permission-editor"]
        ],

        //Contexts
        [
            'name' => 'category-admin.menus.top-menu-contexts',
            "route" => "contexts",
            "link" => '/admin/contexts',
            "permissions" => [$admin]
        ],

        //Categories
        [
            "route" => "category-admin.menus.top-menu",
            "link" => '/admin/categories',
            "permissions" => [$admin, '_user-editor']
        ],


        //Task
        [
            "name" => "task-admin.menus.top-menu",
            "route" => "task",
            "link" => '/admin/task',
            "permissions" => [$admin]
        ],

        //User Task
        [
            "name" => "task-admin.menus.top-usermenu",
            "route" => "usertask.list",
            "link" => '/user/task',
            "permissions" => []
        ],
    ]
];
