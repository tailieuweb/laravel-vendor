<?php namespace Foostart\Module\Controllers\Front;

/*
|-----------------------------------------------------------------------
| ModuleAdminController
|-----------------------------------------------------------------------
| @author: Kang
| @website: http://foostart.com
| @date: 28/12/2017
|
*/


use Illuminate\Http\Request;
use URL, Route, Redirect;
use Illuminate\Support\Facades\App;

use Foostart\Category\Library\Controllers\FooController;
use Foostart\Module\Models\Module;
use Foostart\Category\Models\Category;
use Foostart\Module\Validators\ModuleValidator;
use Illuminate\Support\Facades\DB;
use Foostart\Module\Validators\SampleValidator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Mail\Mailable;

class ModuleController extends FooController {
    public $obj_item = NULL;
    public $obj_category = NULL;
    
    public $statuses = NULL;
    public $obj_sample = NULL;
    public function __construct() {

        parent::__construct();
        // models
        $this->obj_item = new Module(array('perPage' => 10));
        $this->obj_category = new Category();

        // validators
        $this->obj_validator = new ModuleValidator();
        $this->obj_validator_sample = new SampleValidator();
        // set language files
        $this->plang_admin = 'module-admin';
        $this->plang_front = 'module-front';

        // package name
        $this->package_name = 'package-module';
        $this->package_base_name = 'module';

        // root routers
        $this->root_router = 'modules';

        // page views
        $this->page_views = [
            'front' => [
                'home' => $this->package_name.'::front.'.$this->package_base_name.'-module',
                
            ]
        ];

    }


    public function index(Request $request) {

        return view($this->page_views['front']['home']);
    }

    

    public function create(Request $request) {

        $item = NULL;
       
        $params = $request->all();
        

        $id = (int) $request->get('id');
        $is_valid_request = $this->isValidRequest($request);
        
            $item = $this->obj_item->insertSample($params);
           
            if (!empty($item)) {

                    //message
                    return Redirect::route($this->root_router.'.home', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-ok'));
                } else {

                    //message
                    return Redirect::route($this->root_router.'.home', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-error'));
                
                }
                return redirect()->back();
                   
    }
}