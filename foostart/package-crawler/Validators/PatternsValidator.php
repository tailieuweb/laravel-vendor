<?php namespace Foostart\Crawler\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Crawler\Models\Patterns;

use Illuminate\Support\MessageBag as MessageBag;

class PatternsValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'pattern_name' => ["required"],
            'pattern_machine_name' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_crawler = new Patterns();

        // language
        $this->lang_front = 'crawler-front';
        $this->lang_admin = 'crawler-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'pattern_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.pattern_name')]),
                'pattern_machine_name.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.pattern_machine_name')]),
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
                'key' => 'pattern_name',
                'label' => trans($this->lang_admin.'.fields.pattern_name'),
                'min' => $_ln['pattern_name']['min'],
                'max' => $_ln['pattern_name']['max'],
            ],
            'machine_name' => [
                'key' => 'pattern_machine_name',
                'label' => trans($this->lang_admin.'.fields.pattern_machine_name'),
                'min' => $_ln['pattern_machine_name']['min'],
                'max' => $_ln['pattern_machine_name']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['pattern_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['pattern_machine_name'], $params['machine_name']) ? $flag : FALSE;
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
            'pattern_machine_name' => ["required"],
            'pattern_name' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}
