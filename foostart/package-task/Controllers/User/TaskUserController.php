<?php

namespace Foostart\Task\Controllers\User;

use App\Http\Controllers\Controller;
use Foostart\Category\Library\Controllers\FooController;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Task\Models\Tasks;
use Foostart\Task\Models\TaskUser;

class TaskUserController extends FooController
{

    public $taskUser;
    public $data = array();

    public function __construct() {
        $this->taskUser = new TaskUser();

        // set language files
        $this->plang_admin = 'task-admin';
        $this->plang_front = 'task-front';

        // package name
        $this->package_name = 'package-task';
        $this->package_base_name = 'task';

        // page views
        $this->page_views = [
            'user' => [
                'items' => $this->package_name.'::user.'.$this->package_base_name.'-items',
                'edit'  => $this->package_name.'::user.'.$this->package_base_name.'-edit',
                'config'  => $this->package_name.'::user.'.$this->package_base_name.'-config',
                'lang'  => $this->package_name.'::user.'.$this->package_base_name.'-lang',
            ]
        ];

        $this->data_view['status'] = $this->taskUser->getPluckStatus();
    }

    /*
     * Mobile
     */
    public function index(Request $request)
    {
        //Get user id
        $user_id = $request->get('user_id');
        $params = [
          'user_id' => $user_id
        ];
        $assignedTask = $this->taskUser->selectItems($params);

        return response($assignedTask->toJson(), 200);
    }


    public function view(Request $request)
    {

        //Get user id
        $user_id = $request->get('user_id');
        $task_id = $request->get('task_id');
        $params = [
            'user_id' => $user_id,
            'task_id' => $task_id
        ];
        $assignedTask = $this->taskUser->selectItems($params);

        return response($assignedTask->toJson(), 200);
    }

    /**
     * Web
     * Show list of assigned task
     */
    public function taskList(Request $request)
    {
        $user = $this->getUser();
        //Get user id
        $user_id = $user['user_id'];
        $params = [
            'user_id' => $user_id
        ];
        $this->taskUser->is_pagination = true;
        $params = array_merge($request->all(), $params);
        $assignedTask = $this->taskUser->selectItems($params);

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

        return view($this->page_views['user']['items'], $this->data_view);
    }


    /**
     * Web
     * Show list of assigned task
     */
    public function TaskEdit(Request $request)
    {
        $user = $this->getUser();
        //Get user id
        $user_id = $user['user_id'];
        //Get task id
        $task_id = $request->get('id');
        $params = [
            'user_id' => (int)$user_id,
            'task_id' => (int)$task_id
        ];
        $assignedTask = $this->taskUser->selectItem($params);

        $status = $this->getPluckStatus();

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $assignedTask,
            'request' => $request,
            'params' => $params,
            'status' => $status,
        ));

        return view($this->page_views['user']['edit'], $this->data_view);
    }

    public function TaskPost(Request $request)
    {
        $user = $this->getUser();
        //Get user id
        $user_id = $user['user_id'];
        //Get task id
        $task_id = $request->get('id');
        $params = [
            'user_id' => (int)$user_id,
            'task_id' => (int)$task_id
        ];
        $assignedTask = $this->taskUser->selectItem($params);
        $data = $request->all();
        if (!empty($assignedTask)) {
            //Update
            $data['id'] = $assignedTask->assignee_id;
            $data = array_merge($params, $data);
            $this->taskUser->updateItem($data);
            //message
            return Redirect::route('usertask.edit', ["id" => $task_id])
                ->withMessage(trans($this->plang_admin.'.actions.add-ok'));
        }

        //message
        return Redirect::route('usertask.edit', ["id" => $task_id])
            ->withMessage(trans($this->plang_admin.'.actions.add-error'));
    }


    public function mobilePost(Request $request)
    {
        //Get user id
        $user_id = $request->get('user_id');
        //Get task id
        $task_id = $request->get('task_id');
        $params = [
            'user_id' => (int)$user_id,
            'task_id' => (int)$task_id
        ];
        $assignedTask = $this->taskUser->selectItem($params);
        $data = $request->all();
        if (!empty($assignedTask)) {
            //Update
            $data['id'] = $assignedTask->assignee_id;
            $data = array_merge($params, $data);
            $this->taskUser->updateItem($data);

            $assignedTask = $this->taskUser->selectItem($params);
            //message
            return response($assignedTask->toJson(), 200);
        }

        //message
        return response([], 200);
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
    public function getConfigStatus()
    {
        $config_status = config('package-task.status');

        return $config_status;
    }



}
