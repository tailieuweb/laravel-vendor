<?php namespace Foostart\Internship\Models;

use Foostart\Category\Library\Models\FooModel;

class Internship extends FooModel {

    /**
     * @table categories
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);

        if (isset($attributes['perPage'])) {
            $this->perPage = $attributes['perPage'];
        } else {
            $this->perPage = -1;
        }
    }

    public function setConfigs() {

        //table name
        $this->table = 'internship';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            //Company info
            'category_id',
            'user_id',
            'course_id',
            'student_class',
            'student_phone',
            'company_name',
            'company_slug',
            'company_website',
            'company_address',
            'company_description',
            'company_image',
            'company_tax_code',
            'company_phone',
            'company_instructor',
            'company_instructor_phone',
        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
            'company_instructor_phone' => [
                'name' => 'company_instructor_phone',
                'type' => 'Text',
            ],
            'company_instructor' => [
                'name' => 'company_instructor',
                'type' => 'Text',
            ],
            'company_phone' => [
                'name' => 'company_phone',
                'type' => 'Text',
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => 'Int',
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => 'Int',
            ],
            'course_id' => [
                'name' => 'course_id',
                'type' => 'Int',
            ],
            'student_class' => [
                'name' => 'student_class',
                'type' => 'Text',
            ],
            'student_phone' => [
                'name' => 'student_phone',
                'type' => 'Text',
            ],
            'company_name' => [
                'name' => 'company_name',
                'type' => 'Text',
            ],
            'company_slug' => [
                'name' => 'company_slug',
                'type' => 'Text',
            ],
             'company_website' => [
                'name' => 'company_website',
                'type' => 'Text',
            ],
            'company_tax_code' => [
                'name' => 'company_tax_code',
                'type' => 'Text',
            ],
            'company_address' => [
                'name' => 'company_address',
                'type' => 'Text',
            ],
            'company_image' => [
                'name' => 'company_image',
                'type' => 'Text',
            ],
            'company_description' => [
                'name' => 'company_description',
                'type' => 'Text',
            ],
        ]);

        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [
            'category_id',
            'course_id',
            'user_id',
            'student_class',
            'student_phone',
            'company_name',
            'company_slug',
            'company_website',
            'company_address',
            'company_description',
            'company_image',
            'company_tax_code',
            'company_phone',
            'company_instructor',
            'company_instructor_phone',
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'internship_id',
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'keyword',
            'course_id',
            'user_id',
            'status',
        ];

        //primary key
        $this->primaryKey = 'internship_id';

    }

    /**
     * Get list of items
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
     * Get a internship by {id}
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
                        case 'course_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.course_id', '=', $value);
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

                        case 'keyword':
                            if (!empty($value)) {
                                $elo = $elo->where(function($elo) use ($value) {
                                    $elo->where($this->table . '.internship_name', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.internship_website', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.internship_tax_code', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.internship_description','LIKE', "%{$value}%");
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
                            $this->table . '.internship_id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params, $elo) {

        if ($this->perPage > 0 ) {
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
            $item->id = $item->internship_id;


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
     * @return boolean TRUE incase restore successfully otherwise return FALSE
     */
    public function restoreItem(array $input) {

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
     * Get list of companies into select
     * @return OBJECT PLUCK SELECT
     */
     public function pluckSelect($params = array()) {

         $elo = self::orderBy('internship_name', 'ASC');

         $items = $elo->pluck('internship_name', $this->primaryKey);

        return $items;
    }
}
