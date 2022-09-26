<?php namespace Foostart\Slideshow\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Slideshow\Models\Style;
use Illuminate\Support\Facades\File;

use Illuminate\Support\MessageBag as MessageBag;

class StyleValidator extends FooValidator
{

    protected $obj_style;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'style_name' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_style = new Style();

        // language
        $this->lang_front = 'slideshow-admin';
        $this->lang_admin = 'slideshow-admin';

        // event listening
        Event::listen('validating', function ($input) {
            self::$messages = [
                'style_name.required' => trans($this->lang_admin . '.errors.required', ['attribute' => trans($this->lang_admin . '.fields.name')]),
                'style_overview.required' => trans($this->lang_admin . '.errors.required', ['attribute' => trans($this->lang_admin . '.fields.overview')]),
                'style_description.required' => trans($this->lang_admin . '.errors.required', ['attribute' => trans($this->lang_admin . '.fields.description')]),
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

        $_params = [
            'name' => [
                'key' => 'style_name',
                'label' => trans($this->lang_admin . '.fields.name'),
                'min' => $_ln['style_name']['min'],
                'max' => $_ln['style_name']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['style_name'], $_params['name']) ? $flag : FALSE;

        return $flag;
    }

    /***
     * @param array $params
     * @return bool
     */
    public function isExistingView(array $params): bool {
        $fileDir = $params['view_style_path'] . '/' . $params['style_view_file'] . '.blade.php';
        if (File::exists($fileDir)) {
            // Add message error
            $this->errors->add('style_view_file', trans($this->lang_admin . '.errors.existing_view'));
            return true;
        }
        return false;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs()
    {

        $configs = config('package-slideshow');
        return $configs;
    }

}
