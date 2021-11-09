<?php namespace Foostart\Internship\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Internship\Models\Internship;

use Illuminate\Support\MessageBag as MessageBag;

class InternshipDiaryValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'diary_start_date' => ["required"],
            'diary_end_date' => ["required"],
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
                'diary_start_date.required'          => trans($this->lang_admin.'.errors.diary_start_date_required'),
                'diary_end_date.required'          => trans($this->lang_admin.'.errors.diary_end_date_required'),
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
            'diary_start_date' => ["required"],
            'diary_end_date' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }
}
