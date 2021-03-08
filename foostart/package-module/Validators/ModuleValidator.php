<?php namespace Foostart\Module\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Module\Models\Module;

use Illuminate\Support\MessageBag as MessageBag;

class ModuleValidator extends FooValidator
{

    protected $obj_module;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'module_name' => ["required"],
            'module_description' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_module = new Module();

        // language
        $this->lang_front = 'module-front';
        $this->lang_admin = 'module-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'module_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'module_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.description')]),
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
                'key' => 'module_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['module_name']['min'],
                'max' => $_ln['module_name']['max'],
            ],
            'description' => [
                'key' => 'module_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['module_description']['min'],
                'max' => $_ln['module_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['module_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['module_description'], $params['description']) ? $flag : FALSE;
        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-module');
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
            'module_name' => ["required"],
            'module_email' => ["required", "email"],
            'module_title' => ["required"],
            'module_message' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}