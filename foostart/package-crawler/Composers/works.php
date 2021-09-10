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
/**
 * $plang-admin
 * $plang-front
 */
$plang_admin = 'crawler-admin';
$plang_front = 'crawler-front';

View::composer([
            //Works jobs
            'package-crawler::admin.works.jobs.job-edit',
            'package-crawler::admin.works.jobs.job-form',
            'package-crawler::admin.works.jobs.job-items',
            'package-crawler::admin.works.jobs.job-item',
            'package-crawler::admin.works.jobs.job-search',
    ], function ($view) use ($plang_admin, $plang_front) {

        //Order by params
        $params = Request::all();

        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('crawler-admin.sidebar.add') => [
                'url' => URL::route('crawler.work.job.edit', []),
                'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.list_jobs') => [
                'url' => URL::route('crawler.work.job.list', []),
                'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.list_sites') => [
                "url" => URL::route('crawler.site.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.category') => [
                'url' => URL::route('crawler.work.category.list', []),
                'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
            ],
        ];

        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.id'),
            'job_name' => trans($plang_admin.'.fields.job_name'),
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
    //Works categories
    'package-crawler::admin.works.categories.category-edit',
    'package-crawler::admin.works.categories.category-form',
    'package-crawler::admin.works.categories.category-items',
    'package-crawler::admin.works.categories.category-item',
    'package-crawler::admin.works.categories.category-search',
], function ($view) use ($plang_admin, $plang_front) {

    //Order by params
    $params = Request::all();

    /**
     * $sidebar_items
     */
    $sidebar_items = [
        trans('crawler-admin.sidebar.add') => [
            'url' => URL::route('crawler.work.category.edit', []),
            'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
        ],
        trans('crawler-admin.sidebar.list_categories') => [
            'url' => URL::route('crawler.work.category.list', []),
            'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
        ],
        trans('crawler-admin.sidebar.list_sites') => [
            "url" => URL::route('crawler.site.list', []),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ],
        trans('crawler-admin.sidebar.list_jobs') => [
            'url' => URL::route('crawler.work.job.list', []),
            'icon' => '<i class="fa fa-tags" aria-hidden="true"></i>'
        ],
    ];

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin.'.form.no-selected'),
        'id' => trans($plang_admin.'.fields.id'),
        'category_name' => trans($plang_admin.'.fields.category_name'),
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
