<?php namespace Foostart\Crawler\Validators\Sites;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Crawler\Models\Sites;

use Illuminate\Support\MessageBag as MessageBag;

class StackoverflowQuestionsValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'question_name' => ["required"],
            'question_url' => ["required"],
            'question_description' => ["required"],
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
                'question_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.question_name')]),
                'question_url.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.question_url')]),
                'question_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.question_description')]),
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
            'question_name' => [
                'key' => 'question_name',
                'label' => trans($this->lang_admin.'.fields.question_name'),
                'min' => $_ln['question_name']['min'],
                'max' => $_ln['question_name']['max'],
            ],
            'question_url' => [
                'key' => 'question_url',
                'label' => trans($this->lang_admin.'.fields.question_url'),
                'min' => $_ln['question_url']['min'],
                'max' => $_ln['question_url']['max'],
            ],
            'question_description' => [
                'key' => 'question_description',
                'label' => trans($this->lang_admin.'.fields.question_description'),
                'min' => $_ln['question_description']['min'],
                'max' => $_ln['question_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['question_name'], $params['question_name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['question_url'], $params['question_url']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['question_description'], $params['question_description']) ? $flag : FALSE;
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
