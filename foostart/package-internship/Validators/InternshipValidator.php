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
            'internship_name' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_crawler = new Internship();

        // language
        $this->lang_front = 'crawler-front';
        $this->lang_admin = 'crawler-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'internship_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
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

        //Check length
        $_ln = self::$configs['length'];

        $params = [
            'name' => [
                'key' => 'internship_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['internship_name']['min'],
                'max' => $_ln['internship_name']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['internship_name'], $params['name']) ? $flag : FALSE;

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
            'internship_name' => ["required"],
            'internship_url' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}
