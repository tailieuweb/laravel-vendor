<?php

namespace Foostart\Task\Controlers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Task\Models\Tasks;

class TaskUserController extends Controller
{
    public $data = array();
    public function __construct() {

    }

    public function index(Request $request)
    {

        $obj_task = new Tasks();
        $task = $obj_task->get_task();
        $this->data = array(
            'request' => $request,
            'task' => $task
        );
        return view('task::task.index', $this->data);
    }

}
