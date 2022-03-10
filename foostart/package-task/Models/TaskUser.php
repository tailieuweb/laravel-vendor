<?php namespace Foostart\Task\Models;

use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends FooModel {

    /**
     * @table categories
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);

    }

    public function setConfigs() {

        //table name
        $this->table = 'task_user';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            'user_id',
            'task_id',
            'notes',
        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
            'user_id' => [
                'name' => 'user_id',
                'type' => 'Int',
            ],
            'task_id' => [
                'name' => 'task_id',
                'type' => 'Int',
            ],
            'notes' => [
                'name' => 'notes',
                'type' => 'Text',
            ],
        ]);

        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [
            'user_id',
            'task_id',
            'notes'
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'task_name',
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'keyword',
            'status',
            'task_id',
            'user_id'
        ];

        //primary key
        $this->primaryKey = 'assignee_id';

        //the number of items on page
        $this->perPage = 10;
        $this->is_pagination = false;


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

        $elo = $elo->with('tasks');

        if (!empty($params['keyword'])) {
            $elo = $elo->where(function ($query) use ($params) {
                $query->whereRelation('tasks', 'task_name', 'LIKE', "%{$params['keyword']}%");
                $query->orWhereRelation('tasks', 'task_description', 'LIKE', "%{$params['keyword']}%");
                $query->orWhereRelation('tasks', 'task_overview', 'LIKE', "%{$params['keyword']}%");
            });

        }

        //paginate items
        if ($this->is_pagination) {
            $items = $this->paginateItems($params, $elo);
        } else {
            $items = $elo->get();
        }

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
        if (!empty($params['id'])) {
            $elo = $elo->where($this->primaryKey, $params['id']);
        }


        //first item
        $item = $elo->with('tasks')->first();

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
                        case 'task_name':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.task_name', '=', $value);
                            }
                            break;
                        case 'task_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.task_id', '=', $value);
                            }
                            break;
                        case 'user_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.user_id', '=', $value);
                            }
                            break;
                        case 'status':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.'.$this->field_status, '=', $value);
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
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
                            $this->table . '.assignee_id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params = [], $elo) {
        $items = $elo->with('tasks')->paginate($this->perPage);

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
        $taskUser = $this->selectItem($_params);

        if (!empty($taskUser)) {
            $dataFields = $this->getDataFields($params, $this->fields);

            foreach ($dataFields as $key => $value) {
                $taskUser->$key = $value;
            }

            $taskUser->save();

            //Update task info
            if (!empty($params['task_name'])) {
                $task = new Task();
                $task_id = $params['task_id'];
                $task->updateItem($params, $task_id);
            }
            return $taskUser;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @param INT $id is primary key
     * @return type
     */
    public function updateItems($params = []) {

        //parse user id from submitted form
        $user_ids = $this->parseUserIds($params['invited_member_id']);

        //get task item by conditions
        $_params = [
            'task_id' => $params['task_id'],
        ];
        $taskUsers = $this->selectItems($_params);

        if (!empty($taskUsers)) {
            $invitedUserIds = [];
            foreach ($taskUsers as $taskUser) {
                $invitedUserIds[] = $taskUser->user_id;
            }
            //Get actionUser
            $actionUsers = $this->resetAssignee($user_ids, $invitedUserIds);

            //Add
            foreach ($actionUsers['add'] as $user_id) {
                $_data = [
                    'task_id' => $params['task_id'],
                    'user_id' => $user_id
                ];
                $this->insertItem($_data);
            }
            //Delete
            foreach ($taskUsers as $taskUser) {
                if (in_array($taskUser->user_id, $actionUsers['delete'])) {
                    $this->deleteItem(['id' => $taskUser->id]);
                }
            }
        } else {
            return NULL;
        }
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

        return $item;
    }


    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem($input = [], $delete_type = 'delete-trash') {

        $item = $this->find($input['id']);

        if ($item) {
            switch ($delete_type) {
                case 'delete-trash':
                    return $item->delete();
                case 'delete-forever':
                    return $item->delete();
            }

        }

        return TRUE;
    }

    /**
     * Parse user_id from submitted form
     * @param $invited_member_id
     * @return array
     */
    public function parseUserIds($invited_member_id) {
        $userIds = [];
        if (!empty($invited_member_id) && is_array($invited_member_id)) {
            foreach ($invited_member_id as $id) {
                //Check valid id
                $_id = (int) $id;
                if (!empty($_id)) {
                    $userIds[] = $_id;
                }
            }
        }

        return $userIds;
    }

    /**
     * @param $taskUsers
     * @return array
     */
    public function parseInvitedUserIds($taskUsers) {
        $invitedUserIds = [];
        //
        if (!empty($taskUsers)) {
            foreach ($taskUsers as $taskUser) {
                $invitedUserIds[] = $taskUser->user_id;
            }
        }

        return $invitedUserIds;
    }

    /**
     * @param $userIds
     * @param $invitedUserIds
     */
    public function resetAssignee($userIds, $invitedUserIds) {
        $assignees = [
            'add' => [],
            'delete' => []
        ];

        //add
        foreach ($userIds as $id) {
            if (!in_array($id, $invitedUserIds)) {
                $assignees['add'][] = $id;
            }
        }
        //delete
        foreach ($invitedUserIds as $id) {
            if (!in_array($id, $userIds)) {
                $assignees['delete'][] = $id;
            }
        }

        return $assignees;
    }

    /**
     * Get the task
     */
    public function tasks()
    {
        return $this->belongsTo(Task::class,'task_id', 'task_id');
    }

}
