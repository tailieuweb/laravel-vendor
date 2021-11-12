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

class HomeController extends FrontController {

    public $obj_post = NULL;
    public $category = NULL;

    public function __construct() {

        parent::__construct();

        //object item
        $this->obj_post = new Post();
        $this->category = config('package-category.category');
    }

    /**
     * Home page
     */
    public function index(Request $request) {
        return Redirect::route('admin.home');
        //init
        $user = $this->getUser();

        //Load list of categories
        $params = array(
            'order' => array(
                'category_order' => 'ASC',
            )
        );
        $pg_categories = $this->obj_category->getCategoriesByIdParent($this->category['id_1'], $params);
        $qc_categories = $this->obj_category->getCategoriesByIdParent($this->category['id_2'], $params);

//        $pg_rules = $this->obj_post->getItemsByCategories($pg_categories->childs);
//        $qc_rules = $this->obj_post->getItemsByCategories($qc_categories->childs);

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'request' => $request,
            'assets' => $this->getAssetPage('home'),
            'title' => trans('front.pages.title-home'),
            'user' => $user,
        ));

        return view($this->package_name.'::pages.home', $this->data_view);
    }

}
