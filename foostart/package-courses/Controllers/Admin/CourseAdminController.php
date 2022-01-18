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
use Foostart\Internship\Models\Internship;
use Foostart\Pexcel\Helper\CourseEnrollParser;
use Foostart\Pexcel\Helper\CourseExport;
use Foostart\Pexcel\Helper\CourseExportTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use URL, Route, Redirect;
use Maatwebsite\Excel\Facades\Excel;

use Foostart\Courses\Controllers\Admin\BaseCourseAdminController;
use Foostart\Courses\Models\Course;
use Foostart\Category\Models\Category;
use Foostart\Courses\Validators\CourseValidator;
use Illuminate\Support\Facades\DB;
use Foostart\Acl\Authentication\Repository\UserRepositorySearchFilter;
use Foostart\Category\Helpers\FoostartCategory;


class CourseAdminController extends FooController {

    public $obj_item = NULL;
    public $obj_category = NULL;

    public $statuses = NULL;
    public $obj_sample = NULL;
    public function __construct() {

        parent::__construct();
        // models
        $this->obj_item = new Course(array('perPage' => 30));
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
        $this->root_router = 'course';

        // page views
        $this->page_views = [
            'admin' => [
                'items' => $this->package_name.'::admin.'.$this->package_base_name.'-items',
                'view' => $this->package_name.'::admin.'.$this->package_base_name.'-view',
                'export' => $this->package_name.'::admin.'.$this->package_base_name.'-export',
                'edit'  => $this->package_name.'::admin.'.$this->package_base_name.'-edit',
                'config'  => $this->package_name.'::admin.'.$this->package_base_name.'-config',
                'lang'  => $this->package_name.'::admin.'.$this->package_base_name.'-lang',
                'mail'  => $this->package_name.'::admin.'.$this->package_base_name.'-mail',
            ],
            'teacher' => [
                'items' => $this->package_name.'::admin.'.$this->package_base_name.'-items',
                'view' => $this->package_name.'::admin.'.$this->package_base_name.'-view',
                'edit'  => $this->package_name.'::admin.'.$this->package_base_name.'-edit',
                'lang'  => $this->package_name.'::admin.'.$this->package_base_name.'-lang',
            ]
        ];

        $this->data_view['status'] = $this->obj_item->getPluckStatus();
        $this->data_view['config_status'] = $this->obj_item->config_status; //TODO:

        // //set category
        $this->category_ref_name = 'admin/courses';
    }

    /**
     * Show list of items
     * @return view list of items
     * @date 27/12/2017
     */
    public function index(Request $request) {

        $params = $request->all();

        $courses = $this->obj_item->selectItems($params);


        //get categories by context
        $categories = [];
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $_params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($_params);
        }
        // display view
        $this->data_view = array_merge($this->data_view, array(
            'courses' => $courses,
            'request' => $request,
            'params' => $params,
            'categories' => $categories,
            'config_status' => $this->obj_item->config_status
        ));


        return view($this->page_views['admin']['items'], $this->data_view);
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
    public function edit(Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        $context = $this->obj_item->getContext($this->category_ref_name);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);

            if (empty($item)) {
                return Redirect::route($this->root_router)
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
                    return Redirect::route($this->root_router)
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
     * @param Request $request
     */
    public function exportByTeacher(Request $request) {

        $id = (int)$request->get('id');
        $ids = $request->get('ids');

        $is_valid_request = $this->isValidRequest($request);

        if ($is_valid_request && (!empty($id) || !empty($ids))) {

            $ids = !empty($id)?[$id]:$ids;

            $courseExportTeacher = new CourseExportTeacher();
            $courseExportTeacher->ids = $ids;

            return Excel::download($courseExportTeacher, 'courseExportTeacher.xlsx');

            $flag = false;
            if ($flag) {
                return Redirect::route($this->root_router)
                    ->withMessage(trans($this->plang_admin.'.actions.delete-ok'));
            }
        }

        return Redirect::route($this->root_router)
            ->withMessage(trans($this->plang_admin.'.actions.export_by_teacher_null'));


    }

    /**
     * Delete existing item
     * @return view list of items
     * @date 27/12/2017
     */
    public function delete(Request $request) {

        //Detect exporting by teacher
        $isExportByTeacher = $request->get('export_by_teacher', null);
        if ($isExportByTeacher) {
           return Redirect::route($this->root_router.'.exportByTeacher', $request->all());
        }
        $item = NULL;
        $flag = TRUE;
        $params = array_merge($this->getUser(), $request->all());
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
                return Redirect::route($this->root_router)
                                ->withMessage(trans($this->plang_admin.'.actions.delete-ok'));
            }
        }

        return Redirect::route($this->root_router)
                        ->withMessage(trans($this->plang_admin.'.actions.delete-error'));
    }

    /**
     * Delete existing item
     * @return view list of items
     * @date 27/12/2017
     */
    public function restore(Request $request) {

        $item = NULL;
        $flag = TRUE;
        $params = array_merge($this->getUser(), $request->all());
        $id = (int)$request->get('id');
        $ids = $request->get('ids');

        $is_valid_request = $this->isValidRequest($request);

        if ($is_valid_request && (!empty($id) || !empty($ids))) {

            $ids = !empty($id)?[$id]:$ids;

            foreach ($ids as $id) {

                $params['id'] = $id;

                if (!$this->obj_item->restoreItem($params)) {
                    $flag = FALSE;
                }
            }
            if ($flag) {
                return Redirect::route($this->root_router)
                    ->withMessage(trans($this->plang_admin.'.actions.restore-ok'));
            }
        }

        return Redirect::route($this->root_router)
            ->withMessage(trans($this->plang_admin.'.actions.restore-error'));
    }

    /**
     * View data file form excel
     * @param Request $request
     */
    public function raw(Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);

            if (empty($item)) {
                return Redirect::route($this->root_router . '.list')
                    ->withMessage(trans($this->plang_admin . '.actions.edit-error'));
            }
        }

        $obj_parser = new CourseEnrollParser($item);
        $items = $obj_parser->readData($item);

        return Redirect::route($this->root_router);
    }


    /**
     * View data file form excel
     * @param Request $request
     */
    public function view(Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);
        }

        if (empty($params['id'] || empty($item))) {
            return Redirect::route($this->root_router . '.list')
                ->withMessage(trans($this->plang_admin . '.actions.edit-error'));
        }

        $courseName = $item->course_name;
        // Get student by course id
        $obj_class_user = new ClassesUsers();
        $_params = [
            'course_id' => $params['id']
        ];
        $items = $obj_class_user->selectItems($_params);
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

        //Get company info
        $counterUnCompany = 0;
        if (!empty($items)) {
            $obj_internship = new Internship();
            foreach ($items as $index => $item) {
                $_params = [
                    'user_id' => $item['user_id'],
                    'course_id' => $item['course_id'],
                ];
                $internship = $obj_internship->selectItem($_params);

                //Add company info to user
                if (!empty($internship)) {
                    //Set company info
                    $items[$index]['company_name'] = $internship->company_name;

                    if (empty($internship->company_name)) {
                        $counterUnCompany++;
                    }
                } else {
                    $counterUnCompany++;
                }
            }
        }

        //get categories by context
        $categories = [];
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $_params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($_params);
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'items' => $items,
            'counterUnCompany' => $counterUnCompany,
            'request' => $request,
            'categories' => $categories,
            'courseName' => $courseName
        ));

        return view($this->page_views['admin']['view'], $this->data_view);

    }

    /**
     * View data file form excel
     * @param Request $request
     */
    public function export(Request $request) {

        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['id'] = $request->get('id', NULL);

        if (!empty($params['id'])) {

            $item = $this->obj_item->selectItem($params, FALSE);
        }

        if (empty($params['id'] || empty($item))) {
            return Redirect::route($this->root_router . '.list')
                ->withMessage(trans($this->plang_admin . '.actions.edit-error'));
        }

        $courseName = $item->course_name;
        // Get student by course id
        $obj_class_user = new ClassesUsers();
        $_params = [
            'course_id' => $params['id']
        ];
        $items = $obj_class_user->selectItems($_params);
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

        //Get company info
        $counterUnCompany = 0;
        if (!empty($items)) {
            $obj_internship = new Internship();
            foreach ($items as $index => $item) {
                $_params = [
                    'user_id' => $item['user_id'],
                    'course_id' => $item['course_id'],
                ];
                $internship = $obj_internship->selectItem($_params);

                //Add company info to user
                if (!empty($internship)) {
                    //Set company info
                    $items[$index]['student_class'] = $internship->student_class;
                    $items[$index]['student_phone'] = $internship->student_phone;
                    $items[$index]['company_name'] = $internship->company_name;
                    $items[$index]['company_address'] = $internship->company_address;
                    $items[$index]['company_phone'] = $internship->company_phone;
                    $items[$index]['company_instructor'] = $internship->company_instructor;
                    $items[$index]['company_instructor_phone'] = $internship->company_instructor_phone;

                    if (empty($internship->company_name)) {
                        $counterUnCompany++;
                    }
                } else {
                    $counterUnCompany++;
                }
            }
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'items' => $items,
            'counterUnCompany' => $counterUnCompany,
            'request' => $request,
            'courseName' => $courseName
        ));

        $objCourseExport = new CourseExport();
        $objCourseExport->course = $items;
        $objCourseExport->courseName = $courseName;
        $objCourseExport->counterUnCompany = $counterUnCompany;

        $objCourseExport->view = $this->page_views['admin']['export'];

        return  Excel::download($objCourseExport, $courseName.'.xlsx');

    }

    /**
     * Manage configuration of package
     * @param Request $request
     * @return view config page
     */
    public function config(Request $request) {
        $is_valid_request = $this->isValidRequest($request);
        // display view
        $config_path = realpath(base_path('config/package-crawler.php'));
        $package_path = realpath(base_path('vendor/foostart/package-crawler'));

        $config_bakup = $package_path.'/storage/backup/config';
        if (!file_exists($config_bakup)) {
            mkdir($config_bakup, 0755    , true);
        }
        $config_bakup = realpath($config_bakup);


        if ($version = $request->get('v')) {
            //load backup config
            $content = file_get_contents(base64_decode($version));
        } else {
            //load current config
            $content = file_get_contents($config_path);
        }

        if ($request->isMethod('post') && $is_valid_request) {

            //create backup of current config
            file_put_contents($config_bakup.'/package-course-'.date('YmdHis',time()).'.php', $content);

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
        $langs = config('package-courses.langs');
        $lang_paths = [];
        $package_path = realpath(base_path('vendor/foostart/package-courses'));

        if (!empty($langs) && is_array($langs)) {
            foreach ($langs as $key => $value) {
                $lang_paths[$key] = realpath(base_path('resources/lang/'.$key.'/course-admin.php'));

                $key_backup = $package_path.'/storage/backup/lang/'.$key;

                if (!file_exists($key_backup)) {
                    mkdir($key_backup, 0755    , true);
                }
            }
        }

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

                //format file name crawler-admin-YmdHis.php
                file_put_contents($lang_bakup.'/'.$key.'/course-admin-'.date('YmdHis',time()).'.php', $content);
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
                return Redirect::route($this->root_router)
                                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
            }

            $item->id = NULL;
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
            'categories' => $categories,
            'teachers' => $teachers,
            'request' => $request,
            'context' => $context,
        ));

        return view($this->page_views['admin']['edit'], $this->data_view);
    }

    /**
     * Search user by name
     * @return view edit page
     * @date 23/04/2018
     */
    public function search(Request $request){
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
            $data = DB::table('user_profile')
                ->where('last_name', 'like', '%'.$query.'%')
                ->orWhere('first_name', 'like', '%'.$query.'%')
                ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
                    <tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->first_name.'</td>
                    <td>'.$row->last_name.'</td>
                    </tr>
                    ';
                }
            }else
            {
                $output = '
                <tr>
                    <td align="center" colspan="5">No Data Found</td>
                </tr>
                ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
               );

            echo json_encode($data);

        }
    }

}
