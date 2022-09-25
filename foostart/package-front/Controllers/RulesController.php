<?php namespace Foostart\Front\Controllers;

/*
|-------------------------------------------------------------------------------
| HomeController
|-------------------------------------------------------------------------------
| @author: Foostart
| @id: LPTE03
| @date: 11/04/2019
| @location: B111 - TDC
| @copyright: Foostart
|
*/

use Illuminate\Http\Request;
use URL, Route, Redirect;
use Illuminate\Support\Facades\App;

use Foostart\Front\Controllers\FrontController;

//Models
use Foostart\Category\Models\Category;
use Foostart\Post\Models\Post;
use Foostart\Checklist\Models\Task;
use Foostart\Checklist\Models\CheckedRule;

class RulesController extends FrontController {

    public $obj_rule = NULL;
    public $obj_task = NULL;
    public $obj_checked_rule = NULL;
    public $obj_category = NULL;

    public function __construct() {

        parent::__construct();

        //object item
        $this->obj_category = new Category();
        $this->obj_rules = new Post();
        $this->obj_task = new Task();
        $this->obj_checked_rules = new CheckedRule();
    }

    /**
     * Home page
     */
    public function index($name, $id) {

        $request = new Request();
        //init
        $user = $this->getUser();

        //rules
        $rules= NULL;
        $checked_rules = NULL;
        $current_task = NULL;
        $checked_rule_ids = [];

        //Get category by id
        $params = array(
            'category_id' => $id,
            'limit' => 5,//TODO: config
        );
        $category = $this->obj_category->getCategoryById($id);

        if (empty($category)) {
            return redirect()->route('home', []);
        }

        //Get list of rules by category id
        $rules = $this->obj_rules->selectItems($params);

        //Get current task
        if ($user) {
             $_params = [
                'user_id' => $user->user_id,
                'status' => 99,
            ];

            $current_task = $this->obj_task->selectItem($_params);
        }
        //Get checked rules by current task
        if ($user && $current_task) {
            $checked_rules = $this->obj_checked_rules->getCheckedRules($current_task->task_id);

            if ($checked_rules) {
                foreach ($checked_rules as $checked_rule) {
                   $checked_rule_ids[] = $checked_rule->post_id;
                }
            }
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'request' => $request,
            'assets' => $this->getAssetPage('rules'),
            'title' => $category->category_name,
            'category' => $category,
            'rules' => $rules,
            'user' => $user,
            'current_task' => $current_task,
            'checked_rules' => $checked_rules,
            'checked_rule_ids' => $checked_rule_ids,
        ));

        return view($this->package_name.'::pages.rules', $this->data_view);
    }

}