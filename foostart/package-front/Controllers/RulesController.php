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


class RulesController extends FrontController {

    public $obj_rule = NULL;
    public $obj_task = NULL;
    public $obj_checked_rule = NULL;
    public $obj_category = NULL;

    public function __construct() {

        parent::__construct();

        //object item
    }

    /**
     * Home page
     */
    public function index($name, $id) {
        return 'debug';

    }

}
