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
                //Site
                'package-crawler::admin.crawler.site.site-edit',
                'package-crawler::admin.crawler.site.site-form',
                'package-crawler::admin.crawler.site.site-items',
                'package-crawler::admin.crawler.site.site-item',
                'package-crawler::admin.crawler.site.site-search',
                'package-crawler::admin.crawler-config',
                'package-crawler::admin.crawler-lang',

                //Pattern
                'package-crawler::admin.crawler.pattern.pattern-edit',
                'package-crawler::admin.crawler.pattern.pattern-form',
                'package-crawler::admin.crawler.pattern.pattern-items',
                'package-crawler::admin.crawler.pattern.pattern-item',
                'package-crawler::admin.crawler.pattern.pattern-search',

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
            trans('crawler-admin.sidebar.add') => [
                'url' => URL::route('crawler.site.edit', []),
                'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.list_sites') => [
                "url" => URL::route('crawler.site.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.list_patterns') => [
                "url" => URL::route('crawler.pattern.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.config') => [
                "url" => URL::route('crawler.config', []),
                'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
            ],
            trans('crawler-admin.sidebar.lang') => [
                "url" => URL::route('crawler.lang', []),
                'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
            ],
        ];

        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.site_id'),
            'site_name' => trans($plang_admin.'.fields.site_name'),
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
