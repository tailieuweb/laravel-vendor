<?php namespace Foostart\Crawler\Models\Sites\Stackoverflow;

use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;

class StackoverflowTags extends FooModel {

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
        $this->table = 'site_stackoverflow_tags';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            'tag_name',
            'tag_url',
            'tag_overview',
            'tag_num_questions',
            'tag_other'
        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
            'tag_name' => [
                'name' => 'tag_name',
                'type' => 'Text',
            ],
             'tag_url' => [
                'name' => 'tag_url',
                'type' => 'Text',
            ],
            'tag_overview' => [
                'name' => 'tag_overview',
                'type' => 'Text',
            ],
            'tag_num_questions' => [
                'name' => 'tag_num_questions',
                'type' => 'Int',
            ],
            'tag_other' => [
                'name' => 'tag_other',
                'type' => 'Text',
            ],
        ]);

        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [
            'tag_name',
            'tag_url',
            'tag_overview',
            'tag_num_questions',
            'tag_other',
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'tag_name',
            'tag_num_questions',
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'keyword',
            'status',
        ];

        //primary key
        $this->primaryKey = 'tag_id';

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
                        case 'tag_name':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.tag_name', '=', $value);
                            }
                            break;
                        case 'tag_url':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.tag_url', '=', $value);
                            }
                            break;
                        case 'tag_overview':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.tag_overview', '=', $value);
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
                                    $elo->where($this->table . '.tag_name', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.tag_overview','LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.tag_url','LIKE', "%{$value}%");
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
                            $this->table . '.tag_id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params, $elo) {
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

        $item = $this->find($id);

        if (!empty($item)) {
            $dataFields = $this->getDataFields($params, $this->fields);

            foreach ($dataFields as $key => $value) {
                $item->$key = $value;
            }

            $item->save();
              //add new attribute
            $item->id = $item->tag_id;


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

        $item = self::create($dataFields);

        $key = $this->primaryKey;
        $item->id = $item->$key;

        return $item;
    }

    /**
     * Insert items
     */
    public function insertItems($data = []) {

        foreach ($data['tag_name'] as $key => $tag_name) {

            $item = [
              'user_id' => 1,
              'tag_name' => trim(@$tag_name),
              'tag_url' => trim(@$data['tag_url'][$key]),
              'tag_overview' => trim(@$data['tag_overview'][$key]),
              'tag_num_questions' => trim(@$data['tag_num_questions'][$key]),
              'tag_other' => trim(@$data['tag_other'][$key]),
            ];
            $this->insertItem($item);
        }

    }

    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem(array $input, $delete_type) {

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




}
