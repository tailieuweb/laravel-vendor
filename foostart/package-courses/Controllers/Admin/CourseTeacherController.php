<?php namespace Foostart\Courses\Controllers\Admin;

/*
|-----------------------------------------------------------------------
| CrawlerAdminController
|-----------------------------------------------------------------------
| @author: Kang
| @webcourses: http://foostart.com
| @date: 28/12/2017
|
*/

use Foostart\Category\Library\Controllers\FooController;
use Foostart\Courses\Models\ClassesUsers;
use Foostart\Pexcel\Helper\CourseEnrollParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use URL, Route, Redirect;

use Foostart\Courses\Controllers\Admin\BaseCourseAdminController;
use Foostart\Courses\Models\Course;
use Foostart\Category\Models\Category;
use Foostart\Courses\Validators\CourseValidator;
use Illuminate\Support\Facades\DB;
use Foostart\Acl\Authentication\Repository\UserRepositorySearchFilter;
use Foostart\Category\Helpers\FoostartCategory;

class CourseTeacherController extends FooController {

    public $obj_item = NULL;
    public $obj_category = NULL;

    public $statuses = NULL;
    public $obj_sample = NULL;
    public function __construct() {

        parent::__construct();
        // models
        $this->obj_item = new Course(array('perPage' => 10));
        $this->obj_category = new Category();

        // validators
        $this->obj_validator = new CourseValidator();
        //$this->obj_validator_sample = new SampleValidator();
        // set language files
        $this->plang_admin = 'course-admin';
        $this->plang_front = 'course-front';

        // package name
        $this->package_name = 'package-courses';
        $this->package_base_name = 'course';

        // root routers
        $this->root_router = 'teacher';

        // page views
        $this->page_views = [
            'teacher' => [
                'items' => $this->package_name.'::teacher.'.$this->package_base_name.'-items',
                'view' => $this->package_name.'::teacher.'.$this->package_base_name.'-view',
                'edit'  => $this->package_name.'::teacher.'.$this->package_base_name.'-edit',
            ]
        ];

        $this->data_view['status'] = $this->obj_item->getPluckStatus();

        // //set category
        $this->category_ref_name = 'admin/courses';
    }


    /**
     * Show list of items
     * @return view list of items
     * @date 27/12/2017
     */
    public function coursesByTeacher(Request $request) {

        //Get current logged user
        $user = $this->getUser();
        $teacher_id = $user['user_id'];

        $params = array_merge($this->getUser(), $request->all());

        $courses = $this->obj_item->selectItems($params, $teacher_id);

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'courses' => $courses,
            'request' => $request,
            'params' => $params,
            'config_status' => $this->obj_item->config_status
        ));

        return view($this->page_views['teacher']['items'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function editCourseByTeacher (Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        $context = $this->obj_item->getContext($this->category_ref_name);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);

            if (empty($item)) {
                return Redirect::route($this->root_router . '.course')
                                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
            }
        }

        //get categories by context
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($params);
        }

        $obj_category = new FoostartCategory();
        $params_level = $request->all();
        $params_level['_key'] = $obj_category->getContextKeyByRef('user/level');
        $pluck_select_category_level = $obj_category->pluckSelect($params_level);
        $level_id_teacher = 0;
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

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'teachers' => $teachers,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
        ));
        return view($this->page_views['teacher']['edit'], $this->data_view);
    }




    /**
     * Processing data from POST method: add new item, edit existing item
     * @return view edit page
     * @date 27/12/2017
     */
    public function postCourseByTeacher (Request $request) {

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
                    return Redirect::route($this->root_router.'.course.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.edit-ok'));
                } else {

                    // message
                    return Redirect::route($this->root_router . '.course')
                                    ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
                }

            // add new item
            } else {

                $item = $this->obj_item->insertItem($params);

                if (!empty($item)) {

                    //message
                    return Redirect::route($this->root_router.'.course.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-ok'));
                } else {

                    //message
                    return Redirect::route($this->root_router.'.course.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-error'));
                }

            }

        } else { // invalid data

            $errors = $this->obj_validator->getErrors();

            // passing the id incase fails editing an already existing item
            return Redirect::route($this->root_router.'.course.edit', $id ? ["id" => $id]: [])
                    ->withInput()->withErrors($errors);
        }
    }



    /**
     * View data file form excel
     * @param Request $request
     */
    public function rawCourseByTeacher(Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);

            if (empty($item)) {
                return Redirect::route($this->root_router.'.course' )
                    ->withMessage(trans($this->plang_admin . '.actions.edit-error'));
            }
        }

        $obj_parser = new CourseEnrollParser($item);
        $items = $obj_parser->readData($item);

        return Redirect::route($this->root_router.'.course');
    }


    /**
     * View data file form excel
     * @param Request $request
     */
    public function viewCourseByTeacher(Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);

            if (empty($item)) {
                return Redirect::route($this->root_router.'.course')
                    ->withMessage(trans($this->plang_admin . '.actions.edit-error'));
            }
        }

        $obj_class_user = new ClassesUsers();
        $items = $obj_class_user->selectItems();
        $items = $items->toArray();
        //
        $user_repository = App::make('user_repository');
        $profile_repository = App::make('profile_repository');

        $obj_user = new UserRepositorySearchFilter(0);

        for ($i = 0; $i < count($items); $i++) {
            $params = [
                'id' => $items[$i]['user_id']
            ];
            $user_info = $obj_user->all($params)->first();

            if (!empty($user_info)) {
                $items[$i]['email'] = $user_info->email;
                $items[$i]['user_name'] = $user_info->user_name;
                $items[$i]['first_name'] = $user_info->first_name;
                $items[$i]['last_name'] = $user_info->last_name;
                $items[$i]['phone'] = $user_info->phone;
            }
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'items' => $items,
            'request' => $request,

        ));
        return view($this->page_views['teacher']['view'], $this->data_view);

    }
}
