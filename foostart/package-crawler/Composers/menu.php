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
                'package-crawler::admin.crawler-edit',
                'package-crawler::admin.crawler-form',
                'package-crawler::admin.crawler-items',
                'package-crawler::admin.crawler-item',
                'package-crawler::admin.crawler-search',
                'package-crawler::admin.crawler-config',
                'package-crawler::admin.crawler-lang',
    ], function ($view) {

        //Order by params
        $params = Request::all();

        /**
         * $plang-admin
         * $plang-front
         */
        $plang_admin = 'crawler-admin';
        $plang_front = 'crawler-front';


        $fooCategory = new FooCategory();
        $key = $fooCategory->getContextKeyByRef('admin/crawlers');
        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('crawler-admin.sidebar.add') => [
                'url' => URL::route('sites.edit', []),
                'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.list') => [
                "url" => URL::route('sites.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.category') => [
                'url'  => URL::route('categories.list',['_key='.$key]),
                'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.config') => [
                "url" => URL::route('crawlers.config', []),
                'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.lang') => [
                "url" => URL::route('crawlers.lang', []),
                'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
            ],
        ];

        /**
         * $sorting
         * $order_by
         */
        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.id'),
            'crawler_title' => trans($plang_admin.'.fields.title'),
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
