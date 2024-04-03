<?php

use Foostart\Category\Helpers\SortTable;
use Foostart\Category\Helpers\FooCategory;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

/*
|-----------------------------------------------------------------------
| GLOBAL VARIABLES
|-----------------------------------------------------------------------
|   $sidebar_items
|   $sorting
|   $order_by
|   $plang_admin = 'forum-admin'
|   $plang_front = 'forum-front'
*/
View::composer([
    'package-forum::admin.forum-edit',
    'package-forum::admin.forum-form',
    'package-forum::admin.forum-items',
    'package-forum::admin.forum-item',
    'package-forum::admin.forum-search',
    'package-forum::admin.forum-config',
    'package-forum::admin.forum-lang',
], function ($view) {

    //Order by params
    $params = Request::all();

    /**
     * $plang-admin
     * $plang-front
     */

    $plang_admin = 'forum-admin';
    $plang_front = 'forum-front';

    $fooCategory = new FooCategory();
    $key = $fooCategory->getContextKeyByRef('admin/forums');

    /**
     * $sidebar_items
     */
    $sidebar_items = [
        trans('forum-admin.sidebar.add') => [
            'url' => URL::route('forums.edit', []),
            'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
        ],
        trans('forum-admin.sidebar.list') => [
            "url" => URL::route('forums.list', []),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ],
        trans('forum-admin.sidebar.category') => [
            'url' => URL::route('categories.list', ['_key=' . $key]),
            'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
        ],
        trans('forum-admin.sidebar.config') => [
            "url" => URL::route('forums.configGet', []),
            'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
        ],
        trans('forum-admin.sidebar.lang') => [
            "url" => URL::route('forums.langGet', []),
            'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
        ],
    ];

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin . '.form.no-selected'),
        'id' => trans($plang_admin . '.fields.id'),
        'status' => trans($plang_admin . '.columns.status'),
        'updated_at' => trans($plang_admin . '.fields.updated_at'),
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
    $view->with('sidebar_items', $sidebar_items);
    $view->with('order_by', $order_by);
    $view->with('sorting', $sorting);
    $view->with('plang_admin', $plang_admin);
    $view->with('plang_front', $plang_front);
});
