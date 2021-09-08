<?php namespace Foostart\Crawler\Validators\Works;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use Foostart\Crawler\Models\Works\WorksJobs;
use \LaravelAcl\Library\Validators\AbstractValidator;

use Illuminate\Support\MessageBag as MessageBag;

class JobsValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'job_name' => ["required"],
            'job_name' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_crawler = new WorksJobs();

        // language
        $this->lang_front = 'crawler-front';
        $this->lang_admin = 'crawler-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'job_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'job_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.description')]),
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
                'key' => 'job_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['job_name']['min'],
                'max' => $_ln['job_name']['max'],
            ],
            'description' => [
                'key' => 'job_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['job_description']['min'],
                'max' => $_ln['job_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['job_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['job_description'], $params['description']) ? $flag : FALSE;
        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-crawler');
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
            'job_name' => ["required"],
            'job_description' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}
