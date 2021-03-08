<?php namespace Foostart\Crawler\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Crawler\Models\Sites;

use Illuminate\Support\MessageBag as MessageBag;

class SitesValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'site_name' => ["required"],
            'site_description' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_crawler = new Sites();

        // language
        $this->lang_front = 'crawler-front';
        $this->lang_admin = 'crawler-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'site_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'site_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.description')]),
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
                'key' => 'site_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['site_name']['min'],
                'max' => $_ln['site_name']['max'],
            ],
            'description' => [
                'key' => 'site_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['site_description']['min'],
                'max' => $_ln['site_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['site_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['site_description'], $params['description']) ? $flag : FALSE;
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
            'site_name' => ["required"],
            'site_url' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}
