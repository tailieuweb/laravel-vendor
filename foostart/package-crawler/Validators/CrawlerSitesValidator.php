<?php namespace Foostart\Crawler\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Crawler\Models\CrawlerSites;

use Illuminate\Support\MessageBag as MessageBag;

class CrawlerSitesValidator extends FooValidator
{

    protected $obj_crawler;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'crawler_name' => ["required"],
            'crawler_description' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_crawler = new CrawlerSites();

        // language
        $this->lang_front = 'crawler-front';
        $this->lang_admin = 'crawler-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'crawler_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'crawler_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.description')]),
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
                'key' => 'crawler_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['crawler_name']['min'],
                'max' => $_ln['crawler_name']['max'],
            ],
            'description' => [
                'key' => 'crawler_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['crawler_description']['min'],
                'max' => $_ln['crawler_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['crawler_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['crawler_description'], $params['description']) ? $flag : FALSE;
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
            'crawler_name' => ["required"],
            'crawler_email' => ["required", "email"],
            'crawler_title' => ["required"],
            'crawler_message' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}