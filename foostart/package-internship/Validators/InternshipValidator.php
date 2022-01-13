<?php namespace Foostart\Internship\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Internship\Models\Internship;

use Illuminate\Support\MessageBag as MessageBag;

class InternshipValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'category_id' => ["required"],
            'student_class' => ["required"],
            'student_phone' => ["required","regex:/(0)[\d]{9}/", "max:11"],
            'company_name' => ["required"],
            'company_phone' => ["required","regex:/(0)[\d]{9}|(0)[\d]{10}/", "max:11"],
            'company_instructor' => ["required"],
            'company_instructor_phone' => ["required","regex:/(0)[\d]{9}|(0)[\d]{10}/", "max:11"],
            'company_address' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_crawler = new Internship();

        // language
        $this->lang_front = 'crawler-front';
        $this->lang_admin = 'internship-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'category_id.required'          => trans($this->lang_admin.'.errors.category_id_required'),
                'student_class.required'          => trans($this->lang_admin.'.errors.student_class_required'),
                'student_phone.required'          => trans($this->lang_admin.'.errors.student_phone_required'),
                'student_phone.regex'          => trans($this->lang_admin.'.errors.student_phone_regex'),
                'student_phone.max'          => trans($this->lang_admin.'.errors.student_phone_max_string'),
                'company_name.required'          => trans($this->lang_admin.'.errors.company_name_required'),
                'company_phone.required'          => trans($this->lang_admin.'.errors.company_phone_required'),
                'company_phone.regex'          => trans($this->lang_admin.'.errors.company_phone_regex'),
                'company_phone.max'          => trans($this->lang_admin.'.errors.company_phone_max_string'),
                'company_instructor.required'          => trans($this->lang_admin.'.errors.company_instructor_required'),
                'company_instructor_phone.required'          => trans($this->lang_admin.'.errors.company_instructor_phone_required'),
                'company_instructor_phone.regex'          => trans($this->lang_admin.'.errors.company_instructor_phone_regex'),
                'company_instructor_phone.max'          => trans($this->lang_admin.'.errors.company_instructor_phone_max_string'),
                'company_address.required'          => trans($this->lang_admin.'.errors.company_address_required'),
            ];
        });


    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);

        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-internship');
        return $configs;
    }

    /**
     *
     * @param ARRAY $input
     * @return BOOLEAN
     */
    public function userValidate($input) {
        //set rules
        self::$rules = [
            'company_name' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }
}
