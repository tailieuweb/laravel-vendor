<?php namespace Foostart\Branch\Models;

use Foostart\Category\Library\Models\FooModel;
use Foostart\Comment\Models\Comment;

class LocationDistricts extends FooModel
{

    /**
     * @table location_districts
     * @param array $attributes
     */
    public $user = NULL;
    /**
     * Autoload relation
     * @var string[]
     */
    protected $with = array('wards', 'province');

    public function __construct(array $attributes = array())
    {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);

    }

    public function setConfigs()
    {

        //table name
        $this->table = 'location_districts';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            'province_id',
            'district_code',
            'district_name',
        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
            'province_id' => [
                'name' => 'province_id',
                'type' => 'Text',
            ],
            'district_code' => [
                'name' => 'district_code',
                'type' => 'Text',
            ],
            'district_name' => [
                'name' => 'district_name',
                'type' => 'Text',
            ],

        ]);

        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [
            'province_id',
            'district_code',
            'district_name'
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'province_id',
            'district_code',
            'district_name',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'province_id',
            'district_code',
            'district_name',
        ];

        //primary key
        $this->primaryKey = 'district_id';

    }

    /**
     * Gest list of items
     * @param type $params
     * @return object list of districts
     */
    public function selectItems($params = array())
    {

        //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo);

        //select fields
        $elo = $this->createSelect($elo);

        //order filters
        $elo = $this->orderingFilters($params, $elo);

        //paginate items
        if ($this->is_pagination) {
            $items = $this->paginateItems($params, $elo);
        } else {
            $items = $elo->get();
        }

        return $items;
    }

    /**
     * Get a post by {id}
     * @param ARRAY $params list of parameters
     * @return OBJECT post
     */
    public function selectItem($params = array(), $key = NULL)
    {


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


    public function getComments($post_id)
    {

        // Get post
        $params = array(
            'id' => $post_id,
        );
        $post = $this->selectItem($params);

        // Get comment by context
        $params = array(
            'context_name' => 'post',
            'context_id' => $post_id,
            'by_status' => true,
        );
        $obj_comment = new Comment();
        $obj_comment->user = $this->user;
        $comments = $obj_comment->selectItems($params);

        $users_comments = $obj_comment->mapCommentArray($comments);
        $post->cache_comments = json_encode($users_comments);
        $post->cache_time = time();
        $post->save();

        return $users_comments;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function joinTable(array $params = [])
    {
        return $this;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function searchFilters(array $params, $elo, $by_status = TRUE)
    {

        //filter
        if ($this->isValidFilters($params) && (!empty($params))) {
            foreach ($params as $column => $value) {
                if ($this->isValidValue($value)) {
                    switch ($column) {
                        case 'category_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.category_id', '=', $value);
                            }
                            break;
                        case 'category':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.category_id', '=', $value);
                            }
                            break;
                        case 'user_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.user_id', '=', $value);
                            }
                            break;
                        case 'limit':
                            if (!empty($value)) {
                                $this->perPage = $value;
                                $elo = $elo->limit($value);
                            }
                            break;
                        case '_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.post_id', '!=', $value);
                            }
                            break;
                        case 'status':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.' . $this->field_status, '=', $value);
                            }
                            break;
                        case 'keyword':
                            if (!empty($value)) {
                                $elo = $elo->where(function ($elo) use ($value) {
                                    $elo->where($this->table . '.post_name', 'LIKE', "%{$value}%")
                                        ->orWhere($this->table . '.post_description', 'LIKE', "%{$value}%")
                                        ->orWhere($this->table . '.post_overview', 'LIKE', "%{$value}%");
                                });
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } elseif ($by_status) {

            $elo = $elo->where($this->table . '.' . $this->field_status, '=', $this->config_status['publish']);

        }

        return $elo;
    }

    /**
     * Select list of columns in table
     * @param ELOQUENT OBJECT
     * @return ELOQUENT OBJECT
     */
    public function createSelect($elo)
    {

        $elo = $elo->select($this->table . '.*',
            $this->table . '.post_id as id'
        );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params, $elo)
    {
        $items = $elo->paginate($this->perPage);

        return $items;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @param INT $id is primary key
     * @return type
     */
    public function updateItem($params = [], $id = NULL)
    {

        if (empty($id)) {
            $id = $params['id'];
        }
        $field_status = $this->field_status;

        //get post item by conditions
        $_params = [
            'id' => $id,
        ];
        $post = $this->selectItem($_params);

        if (!empty($post)) {
            $dataFields = $this->getDataFields($params, $this->fields);

            foreach ($dataFields as $key => $value) {
                $post->$key = $value;
            }

            $post->save();

            return $post;
        } else {
            return NULL;
        }
    }


    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT post
     */
    public function insertItem($params = [])
    {

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
    public function deleteItem(?array $input, $delete_type)
    {

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

    public function getCoursesByCategoriesRoot($categories)
    {

        $this->is_pagination = false;

        if (!empty($categories)) {

            //get courses of category root
            $_params = [
                'limit' => 9,
                'category' => $categories->category_id,
                'is_pagination' => false
            ];
            $categories->courses = $this->selectItems($_params);

            //get courses of category childs
            foreach ($categories->childs as $key => $category) {
                $ids = [$category->category_id => 1];
                if (!empty($category->category_id_child_str)) {
                    $ids += (array)json_decode($category->category_id_child_str);;
                }
                $ids = array_keys($ids);

                //error
                $_temp = $categories->childs[$key];
                $_temp->courses = $this->getCouresByCategoryIds($ids);
            }


        }
        return $categories;
    }

    public function getCouresByCategoryIds($ids)
    {
        $courses = self::whereIn('category_id', $ids)
            ->paginate($this->perPage);
        return $courses;
    }


    public function getItemsByCategories($categories)
    {

        $items = [];
        $ids = [];

        foreach ($categories as $category) {
            $ids += [$category->category_id => 1];

            if (!empty($category->category_id_child_str)) {
                $ids += (array)json_decode($category->category_id_child_str);
            }
        }

        //Get list of items by ids
        $items = $this->getCouresByCategoryIds(array_keys($ids));

        return $items;
    }

    /**
     * Get list of wards for the district
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wards()
    {
        return $this->hasMany(LocationWards::class, 'district_code', 'district_code');
    }

    /**
     * Get the province that owns the district.
     */
    public function province()
    {
        return $this->belongsTo(LocationProvinces::class, 'province_code', 'province_code');
    }

}
