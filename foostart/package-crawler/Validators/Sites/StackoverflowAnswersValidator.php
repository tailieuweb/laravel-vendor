<?php namespace Foostart\Crawler\Validators\Sites;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Crawler\Models\Sites;

use Illuminate\Support\MessageBag as MessageBag;

class StackoverflowAnswersValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'answer_url_user' => ["required"],
            'answer_description' => ["required"],
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
                'answer_url_user.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.answer_url')]),
                'answer_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.answer_description')]),
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
            'answer_url_user' => [
                'key' => 'answer_url_user',
                'label' => trans($this->lang_admin.'.fields.answer_url_user'),
                'min' => $_ln['answer_url_user']['min'],
                'max' => $_ln['answer_url_user']['max'],
            ],
            'answer_description' => [
                'key' => 'answer_description',
                'label' => trans($this->lang_admin.'.fields.answer_description'),
                'min' => $_ln['answer_description']['min'],
                'max' => $_ln['answer_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['answer_url_user'], $params['answer_url_user']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['answer_description'], $params['answer_description']) ? $flag : FALSE;
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
            'answer_url_user' => ["required"],
            'answer_description' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}
