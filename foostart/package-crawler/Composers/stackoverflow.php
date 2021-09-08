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
|   $plang_admin = 'crawler-admin'
|   $plang_front = 'crawler-front'
*/
View::composer([
            //Stackoverflow tag
            'package-crawler::admin.site.stackoverflow.tag-edit',
            'package-crawler::admin.site.stackoverflow.tag-form',
            'package-crawler::admin.site.stackoverflow.tag-items',
            'package-crawler::admin.site.stackoverflow.tag-item',
            'package-crawler::admin.site.stackoverflow.tag-search',
    ], function ($view) {

        //Order by params
        $params = Request::all();

        /**
         * $plang-admin
         * $plang-front
         */
        $plang_admin = 'crawler-admin';
        $plang_front = 'crawler-front';

        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('crawler-admin.sidebar.tags') => [
                'url' => URL::route('crawler.site.stackoverflow.tag.list', []),
                'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.questions') => [
                'url' => URL::route('crawler.site.stackoverflow.question.list', []),
                'icon' => '<i class="fa fa-question-circle" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.list_sites') => [
                "url" => URL::route('crawler.site.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ]
        ];

        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'tag_name' => trans($plang_admin.'.fields.tag_name'),
            'tag_num_questions' => trans($plang_admin.'.fields.num_questions'),
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

View::composer([
    //Stackoverflow question
    'package-crawler::admin.site.stackoverflow.question-edit',
    'package-crawler::admin.site.stackoverflow.question-form',
    'package-crawler::admin.site.stackoverflow.question-items',
    'package-crawler::admin.site.stackoverflow.question-item',
    'package-crawler::admin.site.stackoverflow.question-search',
], function ($view) {

    //Order by params
    $params = Request::all();

    /**
     * $plang-admin
     * $plang-front
     */
    $plang_admin = 'crawler-admin';
    $plang_front = 'crawler-front';

    /**
     * $sidebar_items
     */
    $sidebar_items = [
        trans('crawler-admin.sidebar.tags') => [
            'url' => URL::route('crawler.site.stackoverflow.tag.list', []),
            'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
        ],
        trans('crawler-admin.sidebar.questions') => [
            'url' => URL::route('crawler.site.stackoverflow.question.list', []),
            'icon' => '<i class="fa fa-question-circle" aria-hidden="true"></i>'
        ],
        trans('crawler-admin.sidebar.list_sites') => [
            "url" => URL::route('crawler.site.list', []),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ]
    ];

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin.'.form.no-selected'),
        'question_name' => trans($plang_admin.'.fields.question_name'),
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


View::composer([
    //Stackoverflow answer
    'package-crawler::admin.site.stackoverflow.answer-edit',
    'package-crawler::admin.site.stackoverflow.answer-form',
    'package-crawler::admin.site.stackoverflow.answer-items',
    'package-crawler::admin.site.stackoverflow.answer-item',
    'package-crawler::admin.site.stackoverflow.answer-search',
], function ($view) {

    //Order by params
    $params = Request::all();

    /**
     * $plang-admin
     * $plang-front
     */
    $plang_admin = 'crawler-admin';
    $plang_front = 'crawler-front';

    /**
     * $sidebar_items
     */
    $sidebar_items = [
        trans('crawler-admin.sidebar.tags') => [
            'url' => URL::route('crawler.site.stackoverflow.tag.list', []),
            'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
        ],
        trans('crawler-admin.sidebar.questions') => [
            'url' => URL::route('crawler.site.stackoverflow.question.list', []),
            'icon' => '<i class="fa fa-question-circle" aria-hidden="true"></i>'
        ],
        trans('crawler-admin.sidebar.list_sites') => [
            "url" => URL::route('crawler.site.list', []),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ]
    ];

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin.'.form.no-selected'),
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
