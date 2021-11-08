<?php

use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use Foostart\Category\Helpers\FooCategory;
use Foostart\Category\Helpers\SortTable;

/*
|-----------------------------------------------------------------------
| GLOBAL VARIABLES
|-----------------------------------------------------------------------
|   $sidebar_items
|   $sorting
|   $order_by
|   $plang_admin = 'course-admin'
|   $plang_front = 'course-front'
*/
View::composer([
                // Course
                'package-courses::admin.course-edit',
                'package-courses::admin.course-form',
                'package-courses::admin.course-items',
                'package-courses::admin.course-item',
                'package-courses::admin.course-search',
                'package-courses::admin.course-config',
                'package-courses::admin.course-lang',
                'package-courses::admin.course-view',
                'package-courses::admin.course-view-item',

    ], function ($view) {

        //Order by params
        $params = Request::all();

        /**
         * $plang-admin
         * $plang-front
         */
        $plang_admin = 'course-admin';
        $plang_front = 'course-front';

        $fooCategory = new FooCategory();
        $key = $fooCategory->getContextKeyByRef('admin/courses');

        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('course-admin.sidebar.add') => [
                'url' => URL::route('course.edit', []),
                'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('course-admin.sidebar.courses') => [
                "url" => URL::route('course', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('pexcel-admin.sidebar.course_category') => [
                'url' => URL::route('categories.list', ['_key=' . $key]),
                'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
            trans('course-admin.sidebar.config') => [
                "url" => URL::route('course.config', []),
                'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
            ],
            trans('course-admin.sidebar.lang') => [
                "url" => URL::route('course.lang', []),
                'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
            ],
        ];

        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.courses_id'),
            'course_name' => trans($plang_admin.'.fields.courses_name'),
            'updated_at' => trans($plang_admin.'.fields.updated_at'),
            'status' => trans($plang_admin.'.fields.status'),
        ];
        $sortTable = new SortTable();
        $sortTable->setOrders($orders);
        $sorting = $sortTable->linkOrders();

        //Order by
        $order_by = [
            'asc' => trans('category-admin.order.by-asc'),
            'desc' => trans('category-admin.order.by-des'),
        ];

        // assign to view
        $view->with('sidebar_items', $sidebar_items );
        $view->with('order_by', $order_by);
        $view->with('sorting', $sorting);
        $view->with('plang_admin', $plang_admin);
        $view->with('plang_front', $plang_front);
});



/*
|-----------------------------------------------------------------------
| GLOBAL VARIABLES
|-----------------------------------------------------------------------
|   $sidebar_items
|   $sorting
|   $order_by
|   $plang_admin = 'course-admin'
|   $plang_front = 'course-front'
*/
View::composer([
    // Course
    'package-courses::teacher.course-edit',
    'package-courses::teacher.course-form',
    'package-courses::teacher.course-items',
    'package-courses::teacher.course-item',
    'package-courses::teacher.course-search',
    'package-courses::teacher.course-view',
    'package-courses::teacher.course-view-item',
], function ($view) {

    //Order by params
    $params = Request::all();

    /**
     * $plang-admin
     * $plang-front
     */
    $plang_admin = 'course-admin';
    $plang_front = 'course-front';

    $fooCategory = new FooCategory();
    $key = $fooCategory->getContextKeyByRef('admin/courses');

    /**
     * $sidebar_items
     */
    $sidebar_items = [
        trans('course-admin.sidebar.courses') => [
            "url" => URL::route('teacher.course', []),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ],

    ];

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin.'.form.no-selected'),
        'id' => trans($plang_admin.'.fields.courses_id'),
        'course_name' => trans($plang_admin.'.fields.courses_name'),
        'updated_at' => trans($plang_admin.'.fields.updated_at'),
        'status' => trans($plang_admin.'.fields.status'),
    ];
    $sortTable = new SortTable();
    $sortTable->setOrders($orders);
    $sorting = $sortTable->linkOrders();

    //Order by
    $order_by = [
        'asc' => trans('category-admin.order.by-asc'),
        'desc' => trans('category-admin.order.by-des'),
    ];

    // assign to view
    $view->with('sidebar_items', $sidebar_items );
    $view->with('order_by', $order_by);
    $view->with('sorting', $sorting);
    $view->with('plang_admin', $plang_admin);
    $view->with('plang_front', $plang_front);
});

