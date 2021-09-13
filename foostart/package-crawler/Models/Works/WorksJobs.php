<?php namespace Foostart\Crawler\Models\Works;

use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;

class WorksJobs extends FooModel {

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
        $this->table = 'crawler_works_jobs';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            'site_id',
            'root_id',
            'job_name',
            'job_url',
            'job_description',
            'job_requirements',
            'job_overview',
        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
             'site_id' => [
                'name' => 'site_id',
                'type' => 'Int',
            ],
            'root_id' => [
                'name' => 'root_id',
                'type' => 'Int',
            ],
            'job_name' => [
                'name' => 'job_name',
                'type' => 'Text',
            ],
            'job_image' => [
                'name' => 'job_image',
                'type' => 'Text',
            ],
            'job_url' => [
                'name' => 'job_url',
                'type' => 'Text',
            ],
            'job_description' => [
                'name' => 'job_description',
                'type' => 'Text',
            ],
            'job_requirements' => [
                'name' => 'job_requirements',
                'type' => 'Text',
            ],
            'job_overview' => [
                'name' => 'job_overview',
                'type' => 'Text',
            ],
        ]);

        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [
            'site_id',
            'job_name',
            'job_image',
            //Relation
            'job_url',
            'root_id',
            'job_description',
            'job_requirements',
            'job_overview',
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'id',
            'job_name',
            'status',
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'keyword',
            'job_url',
            'root_id',
            'status',
        ];

        //primary key
        $this->primaryKey = 'job_id';

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
     * Get a crawler by {id}
     * @param ARRAY $params list of parameters
     * @return OBJECT crawler
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
        $item = $elo->first();

        return $item;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function joinTable(array $params = []){
        return $this->withTrashed();
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function searchFilters(array $params, $elo, $by_status = TRUE){

        //filter
        if ($this->isValidFilters($params) && (!empty($params)))
        {
            foreach($params as $column => $value)
            {
                if($this->isValidValue($value))
                {
                    switch($column)
                    {

                        case 'status':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.'.$this->field_status, '=', $value);
                            }
                            break;
                        case 'job_url':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.job_url','LIKE', "%{$value}%");
                            }
                            break;


                        case 'keyword':
                            if (!empty($value)) {
                                $elo = $elo->where(function($elo) use ($value) {
                                    $elo->where($this->table . '.job_description', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.job_requirements','LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.job_url','LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.job_name','LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.job_overview','LIKE', "%{$value}%");
                                });
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
                            $this->table . '.job_id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params, $elo) {

        if (isset($this->perPage) && ($this->perPage > 0)) {
            $items = $elo->paginate($this->perPage);
        } else {
            $items = $elo->get();
        }


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

        $item = $this->find($id);

        if (!empty($item)) {
            $dataFields = $this->getDataFields($params, $this->fields);

            foreach ($dataFields as $key => $value) {
                $item->$key = $value;
            }

            $item->save();
              //add new attribute
            $item->id = $item->job_id;


            return $item;
        } else {
            return NULL;
        }
    }


    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT crawler
     */
    public function insertItem($params = []) {

        $dataFields = $this->getDataFields($params, $this->fields);
        if ($dataFields['job_url']) {
            $_params = [
                'job_url' => $params['job_url']
            ];
            $isExisting = $this->selectItem($_params);
            if (empty($isExisting)) {
                $item = self::create($dataFields);

                $key = $this->primaryKey;
                $item->id = $item->$key;

                return $item;
            }

        }

    }


    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem(array $input, $delete_type) {

        $item = $this->withTrashed()->find($input['id']);

        if ($item) {
            switch ($delete_type) {
                case 'delete-trash':
                    $item->fdelete($item);
                    return $item->delete();
                case 'delete-forever':
                    return $item->forceDelete();
            }
        }
        return FALSE;
    }



    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function restoreItem(array $input, $delete_type) {

        $item = $this->withTrashed()->find($input['id']);

        if ($item) {
            $item->restore();
        }

        return FALSE;
    }

    /**
     * Get list of statuses to push to select
     * @return ARRAY list of statuses
     */
    public function getPluckStatus() {
        $pluck_status = config('package-crawler.status.list');
        return $pluck_status;
     }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT crawler
     */
    public function insertSample($params = []) {

        $dataFields = $this->getDataFields($params, $this->fields);

        $crawler = new Sites();
        $crawler->fill($params);
        $crawler->save();


        // $item = self::create($dataFields);

        // $key = $this->primaryKey;
        // $item->id = $item->$key;

        return $crawler;
    }

    /**
     * Insert items
     */
    public function insertItems($data = []) {

        foreach ($data['answer_description'] as $key => $value) {

            $item = [
                'question_id' => $data['question_id'],
                'user_id' => 1,
                'answer_description' => trim(@$value),
            ];
            $this->insertItem($item);
        }
    }


}
