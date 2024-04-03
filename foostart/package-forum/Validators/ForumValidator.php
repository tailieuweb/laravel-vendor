<?php namespace Foostart\Forum\Validators;

use Event;
use Foostart\Forum\Models\Forum;
use Illuminate\Support\MessageBag as MessageBag;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Category\Library\Validators\FooValidator;

class ForumValidator extends FooValidator
{

    protected $obj_post;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'title' => ["required"],
//            'overview' => ["required"],
            'description' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_post = new Forum();

        // language
        $this->lang_front = 'forum-front';
        $this->lang_admin = 'forum-admin';

        // event listening
        Event::listen('validating', function ($input) {
            self::$messages = [
                'title.required' => trans($this->lang_admin . '.errors.required', ['attribute' => trans($this->lang_admin . '.fields.name')]),
//                'overview.required' => trans($this->lang_admin . '.errors.required', ['attribute' => trans($this->lang_admin . '.fields.overview')]),
                'description.required' => trans($this->lang_admin . '.errors.required', ['attribute' => trans($this->lang_admin . '.fields.description')]),
            ];
        });


    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input)
    {

        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        //Check length
        $_ln = self::$configs['length'];

        $params = [
            'title' => [
                'key' => 'title',
                'label' => trans($this->lang_admin . '.fields.name'),
                'min' => $_ln['forum_question_title']['min'],
                'max' => $_ln['forum_question_title']['max'],
            ],
//            'overview' => [
//                'key' => 'overview',
//                'label' => trans($this->lang_admin . '.fields.overview'),
//                'min' => $_ln['forum_question_overview']['min'],
//                'max' => $_ln['forum_question_overview']['max'],
//            ],
            'description' => [
                'key' => 'description',
                'label' => trans($this->lang_admin . '.fields.description'),
                'min' => $_ln['forum_question_description']['min'],
                'max' => $_ln['forum_question_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['title'], $params['title']) ? $flag : FALSE;
//        $flag = $this->isValidLength($input['overview'], $params['overview']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['description'], $params['description']) ? $flag : FALSE;

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs()
    {

        $configs = config('package-forum');
        return $configs;
    }

}
