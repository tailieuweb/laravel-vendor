<?php namespace Foostart\Task\Controllers\Admin;

/*
|-----------------------------------------------------------------------
| TaskAdminController
|-----------------------------------------------------------------------
| @author: Kang
| @website: http://foostart.com
| @date: 28/12/2017
|
*/


use Foostart\Acl\Authentication\Repository\UserRepositorySearchFilter;
use Foostart\Category\Helpers\FoostartCategory;
use Illuminate\Http\Request;
use URL, Route, Redirect;
use Illuminate\Support\Facades\App;

use Foostart\Category\Library\Controllers\FooController;
use Foostart\Task\Models\Task;
use Foostart\Task\Models\TaskUser;
use Foostart\Category\Models\Category;
use Foostart\Task\Validators\TaskValidator;


class TaskAdminController extends FooController {

    public $obj_item = NULL;
    public $obj_task_user = NULL;
    public $obj_category = NULL;

    public function __construct() {

        parent::__construct();
        // models
        $this->obj_item = new Task(array('perPage' => 10));
        $this->obj_task_user = new TaskUser();
        $this->obj_category = new Category();

        // validators
        $this->obj_validator = new TaskValidator();

        // set language files
        $this->plang_admin = 'task-admin';
        $this->plang_front = 'task-front';

        // package name
        $this->package_name = 'package-task';
        $this->package_base_name = 'task';

        // root routers
        $this->root_router = 'task';

        // page views
        $this->page_views = [
            'admin' => [
                'items' => $this->package_name.'::admin.'.$this->package_base_name.'-items',
                'edit'  => $this->package_name.'::admin.'.$this->package_base_name.'-edit',
                'config'  => $this->package_name.'::admin.'.$this->package_base_name.'-config',
                'lang'  => $this->package_name.'::admin.'.$this->package_base_name.'-lang',
            ],
            'teacher' => [
                'items' => $this->package_name.'::teacher.'.$this->package_base_name.'-items',
                'tasks' => $this->package_name.'::teacher.'.$this->package_base_name.'-teacher-items',
                'view'  => $this->package_name.'::teacher.'.$this->package_base_name.'-view',
            ],
        ];

        $this->data_view['status'] = $this->obj_item->getPluckStatus();
        $this->data_view['size'] = $this->getConfigSize()['list'];
        $this->data_view['priority'] = $this->getConfigPriority()['list'];

        // //set category
        $this->category_ref_name = 'admin/task';

    }

    /**
     * Show list of items
     * @return view list of items
     * @date 27/12/2017
     */
    public function index(Request $request) {

        $params = $request->all();

        $items = $this->obj_item->selectItems($params);

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'items' => $items,
            'request' => $request,
            'params' => $params,
        ));

        return view($this->page_views['admin']['items'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function edit(Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        $context = $this->obj_item->getContext($this->category_ref_name);
        $invitedMembers = [];
        $task_user = NULL;
        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);

            if (empty($item)) {
                return Redirect::route($this->root_router.'.list')
                                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
            }

            //Get list of invited members of task
            $_params = [
                'task_id' => $item->id
            ];
            $task_user = $this->obj_task_user->selectItems($_params);
        }

        //get categories by context
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($params);
        }

        /**
         * Get list of members for assignee
         * Get list of teachers
         */
        $teachers = $this->getTeachers();
        $invitedMembers = $this->getInvitedMembers($teachers, $task_user);

        $size = $this->getConfigSize();
        $priority = $this->getConfigPriority();

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
            'members' => $teachers,
            'invitedMembers' => $invitedMembers,
            'size' => $size['list'],
            'priority' => $priority['list'],
        ));
        return view($this->page_views['admin']['edit'], $this->data_view);
    }

    /**
     * Processing data from POST method: add new item, edit existing item
     * @return view edit page
     * @date 27/12/2017
     */
    public function post(Request $request) {

        $item = NULL;

        $params = array_merge($this->getUser(), $request->all());

        $is_valid_request = $this->isValidRequest($request);

        $id = (int) $request->get('id');

        if ($is_valid_request && $this->obj_validator->validate($params)) {// valid data

            // update existing item
            if (!empty($id)) {

                $item = $this->obj_item->find($id);

                if (!empty($item)) {

                    $params['id'] = $id;
                    $item = $this->obj_item->updateItem($params);

                    // message
                    return Redirect::route($this->root_router.'.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.edit-ok'));
                } else {

                    // message
                    return Redirect::route($this->root_router.'.list')
                                    ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
                }

            // add new item
            } else {

                $item = $this->obj_item->insertItem($params);

                if (!empty($item)) {

                    //message
                    return Redirect::route($this->root_router.'.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-ok'));
                } else {

                    //message
                    return Redirect::route($this->root_router.'.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-error'));
                }

            }

        } else { // invalid data

            $errors = $this->obj_validator->getErrors();

            // passing the id incase fails editing an already existing item
            return Redirect::route($this->root_router.'.edit', $id ? ["id" => $id]: [])
                    ->withInput()->withErrors($errors);
        }
    }

    /**
     * Delete existing item
     * @return view list of items
     * @date 27/12/2017
     */
    public function delete(Request $request) {

        $item = NULL;
        $flag = TRUE;
        $params = array_merge($request->all(), $this->getUser());
        $delete_type = isset($params['del-forever'])?'delete-forever':'delete-trash';
        $id = (int)$request->get('id');
        $ids = $request->get('ids');

        $is_valid_request = $this->isValidRequest($request);

        if ($is_valid_request && (!empty($id) || !empty($ids))) {

            $ids = !empty($id)?[$id]:$ids;

            foreach ($ids as $id) {

                $params['id'] = $id;

                if (!$this->obj_item->deleteItem($params, $delete_type)) {
                    $flag = FALSE;
                }
            }
            if ($flag) {
                return Redirect::route($this->root_router.'.list')
                                ->withMessage(trans($this->plang_admin.'.actions.delete-ok'));
            }
        }

        return Redirect::route($this->root_router.'.list')
                        ->withMessage(trans($this->plang_admin.'.actions.delete-error'));
    }

    /**
     * Manage configuration of package
     * @param Request $request
     * @return view config page
     */
    public function config(Request $request) {
        $is_valid_request = $this->isValidRequest($request);
        // display view
        $config_path = realpath(base_path('config/package-task.php'));
        $package_path = realpath(base_path('vendor/foostart/package-task'));

        $config_bakup = realpath($package_path.'/storage/backup/config');

        if ($version = $request->get('v')) {
            //load backup config
            $content = file_get_contents(base64_decode($version));
        } else {
            //load current config
            $content = file_get_contents($config_path);
        }

        if ($request->isMethod('post') && $is_valid_request) {

            //create backup of current config
            file_put_contents($config_bakup.'/package-task-'.date('YmdHis',time()).'.php', $content);

            //update new config
            $content = $request->get('content');

            file_put_contents($config_path, $content);
        }

        $backups = array_reverse(glob($config_bakup.'/*'));

        $this->data_view = array_merge($this->data_view, array(
            'request' => $request,
            'content' => $content,
            'backups' => $backups,
        ));

        return view($this->page_views['admin']['config'], $this->data_view);
    }


    /**
     * Manage languages of package
     * @param Request $request
     * @return view lang page
     */
    public function lang(Request $request) {
        $is_valid_request = $this->isValidRequest($request);
        // display view
        $langs = config('package-task.langs');
        $lang_paths = [];

        if (!empty($langs) && is_array($langs)) {
            foreach ($langs as $key => $value) {
                $lang_paths[$key] = realpath(base_path('resources/lang/'.$key.'/task-admin.php'));
            }
        }

        $package_path = realpath(base_path('vendor/foostart/package-task'));

        $lang_bakup = realpath($package_path.'/storage/backup/lang');
        $lang = $request->get('lang')?$request->get('lang'):'en';
        $lang_contents = [];

        if ($version = $request->get('v')) {
            //load backup lang
            $group_backups = base64_decode($version);
            $group_backups = empty($group_backups)?[]: explode(';', $group_backups);

            foreach ($group_backups as $group_backup) {
                $_backup = explode('=', $group_backup);
                $lang_contents[$_backup[0]] = file_get_contents($_backup[1]);
            }

        } else {
            //load current lang
            foreach ($lang_paths as $key => $lang_path) {
                $lang_contents[$key] = file_get_contents($lang_path);
            }
        }

        if ($request->isMethod('post') && $is_valid_request) {

            //create backup of current config
            foreach ($lang_paths as $key => $value) {
                $content = file_get_contents($value);

                //format file name task-admin-YmdHis.php
                file_put_contents($lang_bakup.'/'.$key.'/task-admin-'.date('YmdHis',time()).'.php', $content);
            }


            //update new lang
            foreach ($langs as $key => $value) {
                $content = $request->get($key);
                file_put_contents($lang_paths[$key], $content);
            }

        }

        //get list of backup langs
        $backups = [];
        foreach ($langs as $key => $value) {
            $backups[$key] = array_reverse(glob($lang_bakup.'/'.$key.'/*'));
        }

        $this->data_view = array_merge($this->data_view, array(
            'request' => $request,
            'backups' => $backups,
            'langs'   => $langs,
            'lang_contents' => $lang_contents,
            'lang' => $lang,
        ));

        return view($this->page_views['admin']['lang'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function copy(Request $request) {

        $params = $request->all();

        $item = NULL;
        $params['id'] = $request->get('cid', NULL);

        $context = $this->obj_item->getContext($this->category_ref_name);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);

            if (empty($item)) {
                return Redirect::route($this->root_router.'.list')
                                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
            }

            $item->id = NULL;
        }

        $categories = $this->obj_category->pluckSelect($params);

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
        ));

        return view($this->page_views['admin']['edit'], $this->data_view);
    }

    public function getTeachers() {
        $obj_category = new FoostartCategory();
        $params_level = [];
        $params_level['_key'] = $obj_category->getContextKeyByRef('user/level');
        $pluck_select_category_level = $obj_category->pluckSelect($params_level);

        $level_id_teacher = -1;
        foreach($pluck_select_category_level as $key => $value) {
            if ($value == 'Teacher') {
                $level_id_teacher = $key;
                break;
            }
        }

        //Get list of teachers
        $obj_user = new UserRepositorySearchFilter(0);
        $params = ['level_id' => $level_id_teacher];

        $users = $obj_user->all($params);

        $teachers = [];
        if (!empty($users)) {
            foreach ($users as $user) {
                $teachers[$user->id] = $user->first_name . ' ' . $user->last_name;
            }
        }

        return $teachers;
    }

    public function getInvitedMembers($teachers, $task_user) {
        $invitedMembers = [];

        if (!empty($task_user)) {
            foreach ($task_user as $item) {
                if (!empty($teachers[$item->user_id])) {
                    $invitedMembers[$item->user_id] = $teachers[$item->user_id];
                }
            }
        }
        return $invitedMembers;
    }

    public function getConfigSize()
    {
        $config_size = config('package-task.size');

        return $config_size;
    }

    public function getConfigPriority()
    {
        $config_priority = config('package-task.priority');

        return $config_priority;
    }

    public function teachers(Request $request) {

        $params = $request->all();

        $teachers = $this->teachersTasks($this->getTeachers());
        // display view
        $this->data_view = array_merge($this->data_view, array(
            'items' => $teachers,
            'request' => $request,
            'params' => $params,
        ));



        return view($this->page_views['teacher']['items'], $this->data_view);


    }

    public function teachersTasks($teachers) {


        $teachersTasks = [];
        foreach ($teachers as $index => $value) {
            //
            $_params = [
              'user_id' => $index
            ];
            $this->obj_task_user->is_pagination = false;
            $tasks = $this->obj_task_user->selectItems($_params);
            //
            $teachersTasks[] = [
                'id' => $index,
                'name' => $value,
                'total' => 0,
                'assigned' => 0,
                'canceled' => 0,
                'done' => 0,
                'declined' => 0,
                'inprogress' => 0,
                'pending' => 0,
                'tasks' => $tasks,
            ];
        }

        //Update info
        $status = $this->getConfigStatus();
        $size = $this->getConfigSize();
        $priority = $this->getConfigPriority();

        if (!empty($teachersTasks)) {
            foreach($teachersTasks as $index => $item) {
                if (!empty($item['tasks'])) {
                    //total
                    $teachersTasks[$index]['total'] = $item['tasks']->count();

                    //Other info
                    $assigned = 0;
                    $canceled = 0;
                    $done = 0;
                    $declined = 0;
                    $inprogress = 0;
                    $pending = 0;
                    foreach ($item['tasks'] as $_item) {
                        switch ($_item->status) {
                            case $status['assigned']:
                                $assigned++;
                                break;
                            case $status['canceled']:
                                $canceled++;
                                break;
                            case $status['done']:
                                $done++;
                                break;
                            case $status['declined']:
                                $declined++;
                                break;
                            case $status['inprogress']:
                                $inprogress++;
                                break;
                            case $status['pending']:
                                $pending++;
                                break;
                        }
                    }

                }

                $teachersTasks[$index]['assigned'] = $assigned;
                $teachersTasks[$index]['canceled'] = $canceled;
                $teachersTasks[$index]['done'] = $done;
                $teachersTasks[$index]['declined'] = $declined;
                $teachersTasks[$index]['inprogress'] = $inprogress;
                $teachersTasks[$index]['pending'] = $pending;

            }
        }

        return $teachersTasks;
    }

    public function teachersByTask(Request $request, $user_id) {

        //Get user id
        $params = [
            'user_id' => $user_id
        ];
        $this->obj_task_user->is_pagination = true;
        $params = array_merge($request->all(), $params);
        $assignedTask = $this->obj_task_user->selectItems($params);

        $config_status = $this->getConfigStatus();
        $status = $this->getPluckStatus();

        // display view

        $this->data_view = array_merge($this->data_view, array(
            'items' => $assignedTask,
            'request' => $request,
            'params' => $params,
            'config_status' => $config_status,
            'status' => $status
        ));

        return view($this->page_views['teacher']['tasks'], $this->data_view);
    }
    public function getConfigStatus()
    {
        $config_status = config('package-task.status');

        return $config_status;
    }
    /**
     * Get list of statuses to push to select
     * @return ARRAY list of statuses
     */
    public function getPluckStatus()
    {
        $config_status = config('package-task.status');
        $pluck_status = [];
        if ($config_status && $config_status['list']) {
            $pluck_status = $config_status['list'];
        }
        return $pluck_status;
    }

}
