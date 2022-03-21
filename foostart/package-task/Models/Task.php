<?php namespace Foostart\Task\Models;

use Carbon\Carbon;
use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;
use Foostart\Task\Models\TaskUser;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class Task extends FooModel {

    protected $objTaskUser;
    /**
     * @table categories
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);
        $this->objTaskUser = new TaskUser();
    }

    public function setConfigs() {

        //table name
        $this->table = 'tasks';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            'category_id',
            'task_name',
            'task_name',
            'task_start_date',
            'task_end_date',
            'task_size',
            'task_priority',
            'task_slug',
            'task_overview',
            'task_description',
            'task_image',
            'task_files',
        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
            'task_name' => [
                'name' => 'task_name',
                'type' => 'Text',
            ],
            'task_start_date' => [
                'name' => 'task_start_date',
                'type' => 'Date',
            ],
            'task_end_date' => [
                'name' => 'task_end_date',
                'type' => 'Date',
            ],
            'task_size' => [
                'name' => 'task_size',
                'type' => 'Int',
            ],
            'task_priority' => [
                'name' => 'task_priority',
                'type' => 'Int',
            ],
            'task_slug' => [
                'name' => 'task_slug',
                'type' => 'Text',
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => 'Int',
            ],
            'task_overview' => [
                'name' => 'task_overview',
                'type' => 'Text',
            ],
            'task_description' => [
                'name' => 'task_description',
                'type' => 'Text',
            ],
            'task_image' => [
                'name' => 'task_image',
                'type' => 'Text',
            ],
            'task_files' => [
                'name' => 'files',
                'type' => 'Json',
            ],
        ]);

        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [
            'task_name',
            'task_start_date',
            'task_end_date',
            'task_size',
            'task_priority',
            'task_slug',
            'task_order',
            'category_id',
            'task_overview',
            'task_description',
            'task_image',
            'task_files',
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'task_name',
            'task_start_date',
            'task_end_date',
            'task_size',
            'task_priority',
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'task_start_date',
            'task_end_date',
            'task_size',
            'task_priority',
            'keyword',
            'status',
        ];

        //primary key
        $this->primaryKey = 'task_id';

        //the number of items on page
        $this->perPage = 10;


    }

    /**
     * Gest list of items
     * @param type $params
     * @return object list of categories
     */
    public function selectItems($params = array()) {

        //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo);

        //select fields
        $elo = $this->createSelect($elo);

        //order filters
        $elo = $this->orderingFilters($params, $elo);

        //paginate items
        $items = $this->paginateItems($params, $elo);

        return $items;
    }

    /**
     * Get a task by {id}
     * @param ARRAY $params list of parameters
     * @return OBJECT task
     */
    public function selectItem($params = array(), $key = NULL) {


        if (empty($key)) {
            $key = $this->primaryKey;
        }
       //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo, FALSE);

        //select fields
        $elo = $this->createSelect($elo);

        //id
        $elo = $elo->where($this->primaryKey, $params['id']);

        //first item
        $item = $elo->first();

        return $item;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function joinTable(array $params = []){
        return $this;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function searchFilters(array $params = [], $elo, $by_status = TRUE){

        //filter
        if ($this->isValidFilters($params) && (!empty($params)))
        {

            foreach($params as $column => $value)
            {
                if($this->isValidValue($value))
                {
                    switch($column)
                    {
                        case 'task_start_date':
                            if (!empty($value)) {
                                $value =  Carbon::parse($value)->format('Y-m-d');

                                if (!empty($value)) {
                                    $elo = $elo->where($this->table . '.task_start_date', '>=', $value);
                                }
                            }

                            break;
                        case 'task_end_date':
                            if (!empty($value)) {
                                $value = Carbon::parse($value)->format('Y-m-d');
                                if (!empty($value)) {
                                    $elo = $elo->where($this->table . '.task_end_date', '<=', $value);
                                }
                            }
                            break;
                        case 'task_size':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.task_size', '=', $value);
                            }
                            break;
                        case 'task_priority':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.task_priority', '=', $value);
                            }
                            break;
                        case 'task_name':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.task_name', '=', $value);
                            }
                            break;
                        case 'status':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.'.$this->field_status, '=', $value);
                            }
                            break;
                        case 'keyword':
                            if (!empty($value)) {
                                $elo = $elo->where(function($elo) use ($value) {
                                    $elo->where($this->table . '.task_name', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.task_description','LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.task_overview','LIKE', "%{$value}%");
                                });
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } elseif ($by_status) {
            //$elo = $elo->where($this->table . '.'.$this->field_status, '=', $this->config_status['publish']);

        }

        return $elo;
    }

    /**
     * Select list of columns in table
     * @param ELOQUENT OBJECT
     * @return ELOQUENT OBJECT
     */
    public function createSelect($elo) {

        $elo = $elo->select($this->table . '.*',
                            $this->table . '.task_id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params = [], $elo) {
        $items = $elo->paginate($this->perPage);

        return $items;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @param INT $id is primary key
     * @return type
     */
    public function updateItem($params = [], $id = NULL) {

        if (empty($id)) {
            $id = $params['id'];
        }

        //get task item by conditions
        $_params = [
            'id' => $id,
        ];
        $task = $this->selectItem($_params);

        if (!empty($task)) {
            $dataFields = $this->getDataFields($params, $this->fields);

            foreach ($dataFields as $key => $value) {
                $task->$key = $value;
            }

            $task->save();

            //Add assignee to task
            if (array_key_exists('invited_member_id', $params)) {
                $_params = [
                    'task_id' => $task->task_id,
                    'invited_member_id' => $params['invited_member_id']
                ];
                $this->objTaskUser->updateItems($_params);

                //push notification
                $params['task_id'] = $task->task_id;
                $params['task_name'] = $task->task_name;
                $this->pushNotification($params);
            }

            return $task;
        } else {
            return NULL;
        }
    }

    public function pushNotification($params) {

        $profile_repository = \App::make('profile_repository');

        if (!empty($params['invited_member_id'])) {
            foreach ($params['invited_member_id'] as $user_id) {
                if (!empty($user_id)) {
                    $user_profile = $profile_repository->getFromUserId($user_id);
                    if (!empty($user_profile)) {
                        $data = [
                            'title' => 'Khoa CNTT - Thông báo công việc',
                            'body' => $params['task_name'],
                            'task_id' => $params['task_id']
                        ];
                        $notification = [
                            'title' => 'Khoa CNTT - Thông báo công việc',
                            'body' => $params['task_name'],
                            'task_id' => $params['task_id']
                        ];
                        $this->pushingNotifaction($user_profile->device_token, $data, $notification);
                    }
                }
            }


        }

    }

    public function pushingNotifaction($deviceToken, $data, $notification) {
        $api_file = storage_path('mobirace-3f0df-firebase-adminsdk-f6p60-cbb4e40e25.json');
        $factory = (new Factory)->withServiceAccount($api_file);
        $messaging = $factory->createMessaging();

        $message = CloudMessage::fromArray([
            'token' => $deviceToken,
            'notification' => $notification, // optional
            'data' => $data, // optional
        ]);

        $result = '';
        try {
            $result = $messaging->send($message);
        } catch (\Throwable $e) {

        }


        return $result;
    }


    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT task
     */
    public function insertItem($params = []) {

        $dataFields = $this->getDataFields($params, $this->fields);

        $dataFields[$this->field_status] = $this->config_status['publish'];


        $item = self::create($dataFields);

        $key = $this->primaryKey;
        $item->id = $item->$key;

        //Add assignee to task
        if (array_key_exists('invited_member_id', $params)) {
            $_params = [
                'task_id' => $item->id,
                'invited_member_id' => $params['invited_member_id']
            ];
            $this->objTaskUser->updateItems($_params);
        }


        return $item;
    }


    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem($input = [], $delete_type) {

        $item = $this->find($input['id']);

        if ($item) {
            switch ($delete_type) {
                case 'delete-trash':
                    return $item->fdelete($item);
                    break;
                case 'delete-forever':
                    return $item->delete();
                    break;
            }

        }

        return FALSE;
    }

    /**
     * Get the list of user id
     */
    public function assignee()
    {
        return $this->hasMany(TaskUser::class,'task_id', 'task_id');
    }
}
