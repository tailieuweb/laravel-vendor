<?php namespace Foostart\Internship\Controllers\Admin;

/*
|-----------------------------------------------------------------------
| CrawlerAdminController
|-----------------------------------------------------------------------
| @author: Kang
| @webinternship: http://foostart.com
| @date: 28/12/2017
|
*/
use Foostart\Internship\Models\InternshipDiary;
use Foostart\Category\Library\Controllers\FooController;
use Foostart\Courses\Models\ClassesUsers;
use Illuminate\Http\Request;
use URL, Route, Redirect;
use Illuminate\Support\Facades\App;
use Foostart\Courses\Models\Course;
use Foostart\Internship\Controllers\Admin\BaseInternshipAdminController;
use Foostart\Internship\Models\Internship;
use Foostart\Category\Models\Category;
use Foostart\Internship\Validators\InternshipValidator;
use Foostart\Internship\Validators\InternshipDiaryValidator;
use Illuminate\Support\Facades\DB;

class InternshipAdminController extends FooController {

    public $obj_item = NULL;
    public $obj_category = NULL;

    public $statuses = NULL;
    public $obj_sample = NULL;
    public $obj_validator_diary = NULL;
    public function __construct() {

        parent::__construct();
        // models
        $this->obj_item = new Internship(array('perPage' => 10));
        $this->obj_category = new Category();
        $this->obj_course = new Course();

        // validators
        $this->obj_validator = new InternshipValidator();


        //$this->obj_validator_sample = new SampleValidator();
        // set language files
        $this->plang_admin = 'internship-admin';
        $this->plang_front = 'internship-front';

        // package name
        $this->package_name = 'package-internship';
        $this->package_base_name = 'internship';

        // root routers
        $this->root_router = 'internship';

        // page views
        $this->page_views = [
            'admin' => [
                'items' => $this->package_name.'::admin.'.$this->package_base_name.'-items',
                'diary-items' => $this->package_name.'::admin.'.$this->package_base_name.'-diary-items',
                'edit-company'  => $this->package_name.'::admin.'.$this->package_base_name.'-company-edit',
                'edit-diary'  => $this->package_name.'::admin.'.$this->package_base_name.'-diary-edit',
                'config'  => $this->package_name.'::admin.'.$this->package_base_name.'-config',
                'lang'  => $this->package_name.'::admin.'.$this->package_base_name.'-lang',
                'sample'  => $this->package_name.'::admin.'.$this->package_base_name.'-sample',
                'mail'  => $this->package_name.'::admin.'.$this->package_base_name.'-mail',
            ]
        ];

        $this->data_view['status'] = $this->obj_item->getPluckStatus();

        // //set category
        $this->category_ref_name = 'admin/company';
    }

    /**
     * Show list of items
     * @return view list of items
     * @date 27/12/2017
     */
    public function index(Request $request) {

        //Get current logged user
        $user = $this->getUser();

        $params = $request->all();
        $obj_class_user = new ClassesUsers();
        $params = [
            'user_id' => $user['user_id']
        ];

        //Get class by user
        $classes = $obj_class_user->selectItems($params);

        $classes = $classes->toArray();

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'classes' => $classes,
            'request' => $request,
            'params' => $params,
            'config_status' => $this->obj_item->config_status
        ));

        return view($this->page_views['admin']['items'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function editCompany(Request $request) {

        //Get current logged info
        $user = $this->getUser();

        //Is teacher
        $teacher_id = $request->get('teacher_id');

        //Check teacher is valid
        if (!empty($teacher_id) && ($user['user_id'] != $teacher_id) ) {
            return Redirect::route('teacher.course')
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        } elseif ($user['user_id'] == $teacher_id) {
            return $this->editCompanyByTeacher($request);
        }


        $params = $request->all();
        $obj_class_user = new ClassesUsers();
        $params = [
            'user_id' => $user['user_id']
        ];
        $classes = $obj_class_user->selectItems($params);

        $classes = $classes->toArray();

        //Check valid course
        $course_id = $request->get('course_id');
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }


        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['course_id'] = $request->get('course_id', NULL);
        $params['user_id'] = $user['user_id'];

        if (!empty($params['course_id'])) {
            $item = $this->obj_item->selectItem($params, FALSE);

        }

        //get categories by context
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($params);
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
            'course_id' => $course_id,
        ));
        return view($this->page_views['admin']['edit-company'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function editCompanyByTeacher(Request $request) {

        //Get current logged info
        $user = $this->getUser();

        //Is teacher
        $teacher_id = $request->get('teacher_id');
        $student_id = $request->get('student_id');
        $course_id = $request->get('course_id');

        //Check required param
        if (empty($student_id) || empty($course_id)) {
            return Redirect::route('teacher.course')
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        $params = $request->all();
        $obj_class_user = new ClassesUsers();
        $params = [
            'user_id' => $student_id
        ];
        $classes = $obj_class_user->selectItems($params);

        $classes = $classes->toArray();

        //Check valid course
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }

        //Check valid teacher
        if (!$flag) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }


        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['course_id'] = $request->get('course_id', NULL);
        $params['user_id'] = $student_id;

        if (!empty($params['course_id'])) {
            $item = $this->obj_item->selectItem($params, FALSE);

        }

        //get categories by context
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($params);
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
            'course_id' => $course_id,
            'teacher_id' => $teacher_id,
            'student_id' => $student_id,
        ));
        return view($this->page_views['admin']['edit-company'], $this->data_view);
    }

    /**
     * Processing data from POST method: add new item, edit existing item
     * @return view edit page
     * @date 27/12/2017
     */
    public function postCompany(Request $request) {

        $course_id = $request->get('course_id');
        $student_id = $request->get('student_id');
        $teacher_id = $request->get('teacher_id');

        $user = $this->getUser();
        $obj_class_user = new ClassesUsers();

        //Check valid course
        $course = $this->obj_course->find($course_id);
        if (empty($course)) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Allow teacher edit info
        $isValidTeacher = false;
        if (($course->teacher_id == $user['user_id']) && ($course->teacher_id == $teacher_id)) {
            $isValidTeacher = true;
        }

        //Check valid student in course
        $user_id = null;
        if ($isValidTeacher) {
            $user_id = $student_id;
        } else {
            $user_id = $user['user_id'];
        }
        $_params = [
            'user_id' => $user_id
        ];
        $classes = $obj_class_user->selectItems($_params);
        $classes = $classes->toArray();
        $isValidStudent = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $isValidStudent = true;
                break;
            }
        }

        if (!$isValidStudent && !$isValidTeacher) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        $item = NULL;

        $params = array_merge($this->getUser(), $request->all());

        $is_valid_request = $this->isValidRequest($request);

        $course_id = (int) $request->get('course_id');

        if ($is_valid_request && $this->obj_validator->validate($params)) {// valid data

            $_params = [];
            $_params['course_id'] = $request->get('course_id', NULL);
            $_params['user_id'] = $user_id;

            $item = $this->obj_item->selectItem($_params, FALSE);

            // update existing item
            if (!empty($item)) {

                    $params['id'] = $item->internship_id;
                    $params['user_id'] = $user_id;
                    $item = $this->obj_item->updateItem($params);

                    // message
                    return Redirect::route($this->root_router.'.edit_company', [
                                                            "course_id" => $course_id,
                                                            "teacher_id" => $teacher_id,
                                                            "student_id" => $student_id,
                                                            "_token" => csrf_token()
                                            ])
                                    ->withMessage(trans($this->plang_admin.'.actions.edit-ok'));

            // add new item
            } else {
                $params['user_id'] = $user_id;
                $item = $this->obj_item->insertItem($params);

                if (!empty($item)) {

                    //message
                    return Redirect::route($this->root_router.'.edit_company', [
                                                                                "course_id" => $course_id,
                                                                                "student_id" => $student_id,
                                                                                "teacher_id" => $teacher_id,
                                                                            ])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-ok'));
                } else {

                    //message
                    return Redirect::route($this->root_router.'.edit_company', ["course_id" => $course_id])
                                    ->withMessage(trans($this->plang_admin.'.actions.add-error'));
                }

            }

        } else { // invalid data

            $errors = $this->obj_validator->getErrors();

            // passing the id incase fails editing an already existing item
            return Redirect::route($this->root_router.'.edit_company', ["course_id" => $course_id])
                    ->withInput()->withErrors($errors);
        }
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function diary(Request $request) {
        //Get current logged info
        $user = $this->getUser();

        //Is teacher
        $teacher_id = $request->get('teacher_id');

        //Check teacher is valid
        if ($user['user_id'] != $teacher_id) {
            return Redirect::route('teacher.course')
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        } else {
            return $this->diaryByTeacher($request);
        }



        $params = $request->all();
        $obj_class_user = new ClassesUsers();
        $params = [
            'user_id' => $user['user_id']
        ];
        $classes = $obj_class_user->selectItems($params);

        $classes = $classes->toArray();

        //Check valid course
        $course_id = $request->get('course_id');
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            return Redirect::route($this->root_router, ["course_id" => $course_id])
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }


        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['course_id'] = $request->get('course_id', NULL);
        $params['user_id'] = $user['user_id'];

        if (!empty($params['course_id'])) {
            $item = $this->obj_item->selectItem($params, FALSE);
        }

        //Get diary
        $diaries = [];
        if (!empty($item)) {
            $obj_internship_diary = new InternshipDiary();
            $diaries = $obj_internship_diary->selectItems(['internship_id' => $item->internship_id]);
            if (!empty($diaries)) {
                $diaries = $diaries->toArray();
            }
        }

        //Check unavailable internship
        if (empty($item)) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.internship_diary_unavailable_error'));
        }

        //get categories by context
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($params);
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'internship_id' => $item['internship_id'],
            'diaries' => $diaries,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
            'course_id' => $course_id,
        ));

        return view($this->page_views['admin']['diary-items'], $this->data_view);
    }


    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function diaryByTeacher(Request $request) {
        //Get current logged info
        $user = $this->getUser();

        //Is teacher
        $teacher_id = $request->get('teacher_id');
        $student_id = $request->get('student_id');
        $course_id = $request->get('course_id');

        //Check required param
        if (empty($student_id) || empty($course_id)) {
            return Redirect::route('teacher.course')
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }


        $params = $request->all();
        $obj_class_user = new ClassesUsers();
        $params = [
            'user_id' => $student_id
        ];
        $classes = $obj_class_user->selectItems($params);

        $classes = $classes->toArray();

        //Check valid course
        $course_id = $request->get('course_id');
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            return Redirect::route($this->root_router, ["course_id" => $course_id])
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }


        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['course_id'] = $request->get('course_id', NULL);
        $params['user_id'] = $student_id;

        if (!empty($params['course_id'])) {
            $item = $this->obj_item->selectItem($params, FALSE);
        }

        //Get diary
        $diaries = [];
        if (!empty($item)) {
            $obj_internship_diary = new InternshipDiary();
            $diaries = $obj_internship_diary->selectItems(['internship_id' => $item->internship_id]);
            if (!empty($diaries)) {
                $diaries = $diaries->toArray();
            }
        }

        //Check unavailable internship
        if (empty($item)) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.internship_diary_unavailable_error'));
        }

        //get categories by context
        $context = $this->obj_item->getContext($this->category_ref_name);
        if ($context) {
            $params['context_id'] = $context->context_id;
            $categories = $this->obj_category->pluckSelect($params);
        }

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'internship_id' => $item['internship_id'],
            'diaries' => $diaries,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
            'course_id' => $course_id,
        ));

        return view($this->page_views['admin']['diary-items'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function editDiary(Request $request) {

        //Get current logged info
        $user = $this->getUser();

        //Is teacher
        $teacher_id = $request->get('teacher_id');

        //Check teacher is valid
        if ($user['user_id'] != $teacher_id) {
            return Redirect::route('teacher.course')
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        } else {
            return $this->editDiaryByTeacher($request);
        }


        $params = $request->all();
        $obj_class_user = new ClassesUsers();
        $params = [
            'user_id' => $user['user_id']
        ];
        $classes = $obj_class_user->selectItems($params);

        $classes = $classes->toArray();

        //Check valid course
        $course_id = $request->get('course_id');
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Check internship
        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['course_id'] = $request->get('course_id', NULL);
        $params['user_id'] = $user['user_id'];
        $item = $this->obj_item->selectItem($params, FALSE);

        if (empty($item)) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }


        //Get diary
        $diary = null;
        $internship_diary_id = $request->get('internship_diary_id');
        if (!empty($internship_diary_id)) {
            $obj_internship_diary = new InternshipDiary();
            $diary = $obj_internship_diary->selectItem(['id' => $internship_diary_id]);
            if (empty($diary)) {
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

        //Check internship_id
        $internship_id = $request->get('internship_id');
        if ($internship_id != $item->internship_id) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }
        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'diary' => $diary,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
            'course_id' => $course_id,
            'internship_diary_id' => $internship_diary_id,
            'internship_id' => $internship_id
        ));

        return view($this->page_views['admin']['edit-diary'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function editDiaryByTeacher(Request $request) {

        //Get current logged info
        $user = $this->getUser();

        //Is teacher
        $teacher_id = $request->get('teacher_id');
        $student_id = $request->get('student_id');
        $course_id = $request->get('course_id');

        //Check required param
        if (empty($student_id) || empty($course_id)) {
            return Redirect::route('teacher.course')
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }



        $params = $request->all();
        $obj_class_user = new ClassesUsers();
        $params = [
            'user_id' => $student_id,
        ];
        $classes = $obj_class_user->selectItems($params);

        $classes = $classes->toArray();

        //Check valid course
        $course_id = $request->get('course_id');
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Check internship
        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['course_id'] = $request->get('course_id', NULL);
        $params['user_id'] = $student_id;
        $item = $this->obj_item->selectItem($params, FALSE);

        if (empty($item)) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }


        //Get diary
        $diary = null;
        $internship_diary_id = $request->get('internship_diary_id');
        if (!empty($internship_diary_id)) {
            $obj_internship_diary = new InternshipDiary();
            $diary = $obj_internship_diary->selectItem(['id' => $internship_diary_id]);
            if (empty($diary)) {
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

        //Check internship_id
        $internship_id = $request->get('internship_id');
        if ($internship_id != $item->internship_id) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }
        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'diary' => $diary,
            'categories' => $categories,
            'request' => $request,
            'context' => $context,
            'course_id' => $course_id,
            'internship_diary_id' => $internship_diary_id,
            'internship_id' => $internship_id
        ));

        return view($this->page_views['admin']['edit-diary'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function deleteDiary(Request $request) {

        //Get user info
        $user = $this->getUser();
        $obj_class_user = new ClassesUsers();

        //Get list of class
        $params = [
            'user_id' => $user['user_id']
        ];
        $classes = $obj_class_user->selectItems($params);
        $classes = $classes->toArray();

        //Check valid course
        $course_id = $request->get('course_id');
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Check internship
        $item = NULL;
        $categories = NULL;

        $params = $request->all();
        $params['course_id'] = $request->get('course_id', NULL);
        $params['user_id'] = $user['user_id'];
        $item = $this->obj_item->selectItem($params, FALSE);

        if (empty($item)) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Get diary
        $diary = null;
        $internship_diary_id = $request->get('internship_diary_id');
        if (!empty($internship_diary_id)) {
            $obj_internship_diary = new InternshipDiary();
            $diary = $obj_internship_diary->selectItem(['id' => $internship_diary_id]);
            if (empty($diary)) {
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

        //Check internship_id
        $internship_id = $request->get('internship_id');
        if ($internship_id != $item->internship_id) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Check internship diary id
        $internship_diary_id = $request->get('internship_diary_id');
        if ($internship_diary_id != $diary->internship_diary_id) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }
        if ($internship_id != $diary->internship_id) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Delete
        $obj_internship_diary = new InternshipDiary();
        $obj_internship_diary->deleteItem(['id'=> $internship_diary_id], 'delete-forever');

        return Redirect::route($this->root_router.'.diary', ["course_id" => $course_id,
            '_token' => $request->get('_token', 'secret'),
            'internship_id' => $internship_id])
            ->withMessage(trans($this->plang_admin.'.actions.delete-ok'));


    }
    /**
     * Processing data from POST method: add new item, edit existing item
     * @return view edit page
     * @date 27/12/2017
     */
    public function postDiary(Request $request) {
        //Get user info
        $user = $this->getUser();
        $obj_class_user = new ClassesUsers();

        //Get class by user
        $params = [
            'user_id' => $user['user_id']
        ];
        $classes = $obj_class_user->selectItems($params);
        $classes = $classes->toArray();

        //Check valid course
        $course_id = $request->get('course_id', 0);
        $flag = false;
        foreach ($classes as $class) {
            if ($class['course_id'] == $course_id) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            return Redirect::route($this->root_router)
                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
        }

        //Check valid internship
        $item = NULL;
        $params = array_merge($this->getUser(), $request->all());
        $is_valid_request = $this->isValidRequest($request);
        $course_id = (int) $request->get('course_id');

        $_params = [];
        $_params['course_id'] = $request->get('course_id', NULL);
        $_params['user_id'] = $user['user_id'];

        $item = $this->obj_item->selectItem($_params, FALSE);

        //Check valid internship_id
        $internship_id = $request->get('internship_id');

        if ($internship_id != $item->internship_id) {
            return Redirect::route($this->root_router.'.edit_company', ["course_id" => $course_id, 'internship_id' => $item->internship_id])
                ->withMessage(trans($this->plang_admin.'.actions.add-error'));
        }

        //Internship diary item
        $obj_internship_diary = new InternshipDiary();
        $internship_diary_id = $request->get('internship_diary_id');

        $is_valid_request = $this->isValidRequest($request);
        if ($is_valid_request && $this->obj_validator_diary->validate($params)) {// valid data
            if (!empty($internship_diary_id)) {
                //Update
                $_item = $obj_internship_diary->selectItem(['id' => $internship_diary_id]);
                if (!empty($_item)) {
                    $params['id'] = $internship_diary_id;
                    $obj_internship_diary->updateItem($params);
                    return Redirect::route($this->root_router . '.diary.edit', ["course_id" => $course_id,
                        'internship_diary_id' => $internship_diary_id,
                        'internship_id' => $internship_id])
                        ->withMessage(trans($this->plang_admin . '.actions.edit-ok'));

                } else {
                    return Redirect::route($this->root_router . '.edit_company', ["course_id" => $course_id,
                        'internship_id' => $item->internship_id])
                        ->withMessage(trans($this->plang_admin . '.actions.add-error'));
                }
            } else {
                //Add new
                $item = $obj_internship_diary->insertItem($params);
                return Redirect::route($this->root_router . '.diary', ["course_id" => $course_id,
                    'internship_diary_id' => $item->internship_diary_id,
                    'internship_id' => $internship_id])
                    ->withMessage(trans($this->plang_admin . '.actions.add-ok'));

            }
        }else { // invalid data

            $errors = $this->obj_validator_diary->getErrors();

            // passing the id incase fails editing an already existing item
            return Redirect::route($this->root_router.'.diary.edit', [
                "course_id" => $course_id,
                'internship_diary_id' => $item->internship_diary_id,
                'internship_id' => $internship_id
                ])
                ->withInput()->withErrors($errors);
        }

    }

    /**
     * Delete existing item
     * @return view list of items
     * @date 27/12/2017
     */
    public function delete(Request $request) {

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
            file_put_contents($config_bakup.'/package-internship-'.date('YmdHis',time()).'.php', $content);

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
        $langs = config('package-internship.langs');
        $lang_paths = [];
        $package_path = realpath(base_path('vendor/foostart/package-internship'));

        if (!empty($langs) && is_array($langs)) {
            foreach ($langs as $key => $value) {
                $lang_paths[$key] = realpath(base_path('resources/lang/'.$key.'/internship-admin.php'));

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
                file_put_contents($lang_bakup.'/'.$key.'/internship-admin-'.date('YmdHis',time()).'.php', $content);
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
                return Redirect::route($this->root_router.'.internship')
                                ->withMessage(trans($this->plang_admin.'.actions.edit-error'));
            }

            $item->id = NULL;
        }

        $categories = $this->obj_category->pluckSelect($params);

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'categories' => $categories,
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
