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
use Foostart\Post\Models\Post;
use Foostart\Category\Models\Category;

class RuleController extends FrontController {

    public $obj_rule = NULL;
    public $obj_task = NULL;
    public $obj_checked_rule = NULL;
    public $obj_category = NULL;


    public function __construct() {

        parent::__construct();

        //object item
        //object item
        $this->obj_category = new Category();
        $this->obj_rules = new Post();

    }

    /**
     * Home page
     */
    public function index($name, $id) {

        return 'debug';
        $request = new Request();
        //init
        $user = $this->getUser();

        //rules
        $checked_rules = NULL;
        $current_task = NULL;
        $checked_rule_ids = [];

        //Get rule item by id
        $params = array(
            'id' => $id
        );
        $rule = $this->obj_rules->selectItem($params);

        if (empty($rule)) {
            return redirect()->route('home', []);
        }

        //Get related rules
        $params = [
            'category_id' => $rule->category_id,
            'limit' => 5,
        ];
        $related_rules = $this->obj_rules->selectItems($params);

        ///Get current task
        if ($user) {
             $_params = [
                'user_id' => $user->user_id,
                'status' => 99,
            ];

            $current_task = $this->obj_task->selectItem($_params);
        }

        //Get task rule by task
        if ($user && $current_task) {
            $checked_rules = $this->obj_task->getCheckedRules($current_task->task_id);

            if ($checked_rules) {
               foreach ($checked_rules as $checked_rule) {
                  $checked_rule_ids[] = $checked_rule->post_id;
               }
           }
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'request' => $request,
            'assets' => $this->getAssetPage('rule'),
            'title' => $rule->post_name,
            'related_rules' => $related_rules,
            'user' => $user,
            'checked_rules' => $checked_rules,
            'rule' => $rule,
            'current_task' => $current_task,
            'checked_rule_ids' => $checked_rule_ids,
        ));

        return view($this->package_name.'::pages.rule', $this->data_view);
    }

}
