<?php namespace Foostart\Crawler\Validators\Sites;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Crawler\Models\Sites;

use Illuminate\Support\MessageBag as MessageBag;

class StackoverflowTagsValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'tag_name' => ["required"],
            'tag_url' => ["required"],
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
                'tag_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.tag_name')]),
                'tag_url.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.tag_url')]),
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
            'tag_name' => [
                'key' => 'tag_name',
                'label' => trans($this->lang_admin.'.fields.tag_name'),
                'min' => $_ln['tag_name']['min'],
                'max' => $_ln['tag_name']['max'],
            ],
            'tag_url' => [
                'key' => 'tag_url',
                'label' => trans($this->lang_admin.'.fields.tag_url'),
                'min' => $_ln['tag_url']['min'],
                'max' => $_ln['tag_url']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['tag_name'], $params['tag_name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['tag_url'], $params['tag_url']) ? $flag : FALSE;
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
            'tag_name' => ["required"],
            'tag_url' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }
}
