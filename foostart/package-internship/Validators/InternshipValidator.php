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
            'company_name' => ["required"],
            'company_phone' => ["required"],
            'company_instructor' => ["required"],
            'company_instructor_phone' => ["required"],
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
                'company_name.required'          => trans($this->lang_admin.'.errors.company_name_required'),
                'company_phone.required'          => trans($this->lang_admin.'.errors.company_phone_required'),
                'company_instructor.required'          => trans($this->lang_admin.'.errors.company_instructor_required'),
                'company_instructor_phone.required'          => trans($this->lang_admin.'.errors.company_instructor_phone_required'),
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

dd($this->errors);

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
