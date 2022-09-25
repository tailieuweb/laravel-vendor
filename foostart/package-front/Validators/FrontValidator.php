<?php namespace Foostart\Front\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Front\Models\Front;

use Illuminate\Support\MessageBag as MessageBag;

class FrontValidator extends FooValidator
{

    protected $obj_front;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'front_name' => ["required"],
        ];

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'front_name.required' => trans('front-admin.errors.required', ['attribute' => 'front name']),
            ];
        });

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_front = new Front();
    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){
        $configs = [
            'min_lenght' => config('package-front.name_min_length'),
            'max_lenght' => config('package-front.name_max_length'),
        ];

        return $configs;
    }
}