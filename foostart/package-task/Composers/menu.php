<?php

use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use Foostart\Category\Helpers\FooCategory;

/*
|-----------------------------------------------------------------------
| GLOBAL VARIABLES
|-----------------------------------------------------------------------
|   $sidebar_items
|   $sorting
|   $order_by
|   $plang_admin = 'task-admin'
|   $plang_front = 'task-front'
*/
View::composer([
                'package-task::admin.task-edit',
                'package-task::admin.task-form',
                'package-task::admin.task-items',
                'package-task::admin.task-item',
                'package-task::admin.task-search',
                'package-task::admin.task-config',
                'package-task::admin.task-lang',
                'package-task::teacher.task-items',
                'package-task::teacher.task-view',
    ], function ($view) {

        /**
         * $plang-admin
         * $plang-front
         */
        $plang_admin = 'task-admin';
        $plang_front = 'task-front';

        $view->with('plang_admin', $plang_admin);
        $view->with('plang_front', $plang_front);

        $fooCategory = new FooCategory();
        $key = $fooCategory->getContextKeyByRef('admin/task');
        /**
         * $sidebar_items
         */
        $view->with('sidebar_items', [
            trans('task-admin.sidebar.add') => [
                'url' => URL::route('task.edit', []),
                'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('task-admin.sidebar.list') => [
                "url" => URL::route('task.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('task-admin.sidebar.teachers') => [
                "url" => URL::route('task.teachers', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('task-admin.sidebar.category') => [
                'url'  => URL::route('categories.list',['_key='.$key]),
                'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
            trans('task-admin.sidebar.config') => [
                "url" => URL::route('task.config', []),
                'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
            ],
            trans('task-admin.sidebar.lang') => [
                "url" => URL::route('task.lang', []),
                'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
            ],
        ]);

        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.id'),
            'task_name' => trans($plang_admin.'.fields.name'),
            'updated_at' => trans($plang_admin.'.fields.updated_at'),
        ];
        $sorting = [
            'label' => $orders,
            'items' => [],
            'url' => []
        ];
        //Order by params
        $params = Request::all();

        $order_by = explode(',', @$params['order_by']);
        $ordering = explode(',', @$params['ordering']);
        foreach ($orders as $key => $value) {
            $_order_by = $order_by;
            $_ordering = $ordering;
            if (!empty($key)) {
                //existing key in order
                if (in_array($key, $order_by)) {
                    $index = array_search($key, $order_by);
                    switch ($_ordering[$index]) {
                        case 'asc':
                            $sorting['items'][$key] = 'asc';
                            $_ordering[$index] = 'desc';
                            break;
                        case 'desc':
                             $sorting['items'][$key] = 'desc';
                            $_ordering[$index] = 'asc';
                            break;
                        default:
                            break;
                    }
                    $order_by_str = implode(',', $_order_by);
                    $ordering_str = implode(',', $_ordering);

                } else {//new key in order
                    $sorting['items'][$key] = 'none';//asc
                    if (empty($params['order_by'])) {
                        $order_by_str = $key;
                        $ordering_str = 'asc';
                    } else {
                        $_order_by[] = $key;
                        $_ordering[] = 'asc';
                        $order_by_str = implode(',', $_order_by);
                        $ordering_str = implode(',', $_ordering);
                    }
                }
                $sorting['url'][$key]['order_by'] = $order_by_str;
                $sorting['url'][$key]['ordering'] = $ordering_str;
            }
        }
        foreach ($sorting['url'] as $key => $item) {
            $params['order_by'] = $item['order_by'];
            $params['ordering'] = $item['ordering'];
            $sorting['url'][$key] = Request::url().'?'.http_build_query($params);
        }
        $view->with('sorting', $sorting);

        //Order by
        $order_by = [
            'asc' => trans('foostart.order_by.asc'),
            'desc' => trans('foostart.order_by.desc'),
        ];
        $view->with('order_by', $order_by);
});


View::composer([
    'package-task::user.task-edit',
    'package-task::user.task-form',
    'package-task::user.task-items',
    'package-task::user.task-item',
    'package-task::user.task-search',

], function ($view) {

    /**
     * $plang-admin
     * $plang-front
     */
    $plang_admin = 'task-admin';
    $plang_front = 'task-front';

    $view->with('plang_admin', $plang_admin);
    $view->with('plang_front', $plang_front);

    $fooCategory = new FooCategory();
    $key = $fooCategory->getContextKeyByRef('admin/task');
    /**
     * $sidebar_items
     */
    $view->with('sidebar_items', [

        trans('task-admin.sidebar.list') => [
            "url" => URL::route('usertask.list', []),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ]

    ]);

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin.'.form.no-selected'),
        'id' => trans($plang_admin.'.fields.id'),
        'task_name' => trans($plang_admin.'.fields.name'),
        'status' => trans($plang_admin.'.fields.status'),
        'updated_at' => trans($plang_admin.'.fields.updated_at'),
    ];
    $sorting = [
        'label' => $orders,
        'items' => [],
        'url' => []
    ];
    //Order by params
    $params = Request::all();

    $order_by = explode(',', @$params['order_by']);
    $ordering = explode(',', @$params['ordering']);
    foreach ($orders as $key => $value) {
        $_order_by = $order_by;
        $_ordering = $ordering;
        if (!empty($key)) {
            //existing key in order
            if (in_array($key, $order_by)) {
                $index = array_search($key, $order_by);
                switch ($_ordering[$index]) {
                    case 'asc':
                        $sorting['items'][$key] = 'asc';
                        $_ordering[$index] = 'desc';
                        break;
                    case 'desc':
                        $sorting['items'][$key] = 'desc';
                        $_ordering[$index] = 'asc';
                        break;
                    default:
                        break;
                }
                $order_by_str = implode(',', $_order_by);
                $ordering_str = implode(',', $_ordering);

            } else {//new key in order
                $sorting['items'][$key] = 'none';//asc
                if (empty($params['order_by'])) {
                    $order_by_str = $key;
                    $ordering_str = 'asc';
                } else {
                    $_order_by[] = $key;
                    $_ordering[] = 'asc';
                    $order_by_str = implode(',', $_order_by);
                    $ordering_str = implode(',', $_ordering);
                }
            }
            $sorting['url'][$key]['order_by'] = $order_by_str;
            $sorting['url'][$key]['ordering'] = $ordering_str;
        }
    }
    foreach ($sorting['url'] as $key => $item) {
        $params['order_by'] = $item['order_by'];
        $params['ordering'] = $item['ordering'];
        $sorting['url'][$key] = Request::url().'?'.http_build_query($params);
    }
    $view->with('sorting', $sorting);

    //Order by
    $order_by = [
        'asc' => trans('foostart.order_by.asc'),
        'desc' => trans('foostart.order_by.desc'),
    ];
    $view->with('order_by', $order_by);
});
