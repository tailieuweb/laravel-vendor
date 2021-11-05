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
|   $plang_admin = 'internship-admin'
|   $plang_front = 'internship-front'
*/
View::composer([
                // Internship
                'package-internship::admin.internship-edit',
                'package-internship::admin.internship-form',
                'package-internship::admin.internship-items',
                'package-internship::admin.internship-item',
                'package-internship::admin.internship-search',
                'package-internship::admin.internship-config',
                'package-internship::admin.internship-lang',
                'package-internship::admin.internship-company-edit',
                'package-internship::admin.internship-company-form',

    ], function ($view) {

        //Order by params
        $params = Request::all();

        /**
         * $plang-admin
         * $plang-front
         */
        $plang_admin = 'internship-admin';
        $plang_front = 'internship-front';

        $fooCategory = new FooCategory();
        $key = $fooCategory->getContextKeyByRef('admin/internship');

        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('internship-admin.sidebar.list_internship_courses') => [
                "url" => URL::route('internship', []),
                'icon' => '<i class="fa fa-newspaper-o" aria-hidden="true"></i>'
            ],
        ];

        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.internship_id'),
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
|   $plang_admin = 'internship-admin'
|   $plang_front = 'internship-front'
*/
View::composer([
    // Internship diary
    'package-internship::admin.internship-diary-items',
    'package-internship::admin.internship-diary-item',
    'package-internship::admin.internship-diary-edit',
    'package-internship::admin.internship-diary-form',

], function ($view) {

    //Order by params
    $params = Request::all();

    /**
     * $plang-admin
     * $plang-front
     */
    $plang_admin = 'internship-admin';
    $plang_front = 'internship-front';

    $fooCategory = new FooCategory();
    $key = $fooCategory->getContextKeyByRef('admin/internship');

    /**
     * $sidebar_items
     */
    $sidebar_items = [
        trans('internship-admin.sidebar.list_internship_courses') => [
            "url" => URL::route('internship', []),
            'icon' => '<i class="fa fa-newspaper-o" aria-hidden="true"></i>'
        ],
    ];

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin.'.form.no-selected'),
        'id' => trans($plang_admin.'.fields.internship_id'),
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
