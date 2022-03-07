<?php namespace Foostart\Task\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Task\Models\Task;

use Illuminate\Support\MessageBag as MessageBag;

class TaskValidator extends FooValidator
{

    protected $obj_task;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'task_name' => ["required"],
            'task_start_date' => ["required"],
            'task_end_date' => ["required"],
            'category_id' => ["required"],
            'task_size' => ["required"],
            'task_priority' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_task = new Task();

        // language
        $this->lang_front = 'task-front';
        $this->lang_admin = 'task-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'task_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.task_name')]),
                'task_start_date.required'      => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.task_start_date')]),
                'task_end_date.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.task_end_date')]),
                'category_id.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.category_id')]),
                'task_size.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.task_size')]),
                'task_priority.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.task_priority')]),
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
                'key' => 'task_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['task_name']['min'],
                'max' => $_ln['task_name']['max'],
            ],

        ];
        $flag = $this->isValidLength($input['task_name'], $params['name']) ? $flag : FALSE;

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-task');
        return $configs;
    }

}
