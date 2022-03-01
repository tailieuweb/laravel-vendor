<?php

namespace Foostart\Task\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Task\Models\Tasks;
use Foostart\Task\Models\TaskUser;

class TaskUserController extends Controller
{

    public $taskUser;
    public $data = array();

    public function __construct() {
        $this->taskUser = new TaskUser();
    }

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


}
