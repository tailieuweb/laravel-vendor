<?php namespace Foostart\Forum\Models;

use Illuminate\Support\Facades\DB;
use Foostart\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Foostart\Category\Library\Models\FooModel;

class ForumDiscussions extends FooModel
{

    /**
     * @table categories
     * @param array $attributes
     */
    public $user = NULL;

    public function __construct(array $attributes = array())
    {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);

    }

    public function setConfigs()
    {

        //table name
        $this->table = 'forum_discussions';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            'forum_questions_id',
            'forum_discussions_description',
            'forum_discussions_files',
        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
            'forum_questions_id' => [
                'name' => 'id',
                'type' => 'Int',
            ],
            'forum_discussions_description' => [
                'name' => 'answer',
                'type' => 'Text',
            ],
        ]);

        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [
            'forum_questions_id',
            'forum_discussions_description',
            'forum_discussions_files',
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'keyword',
            'status',
            'category',
            '_id',
            'limit',
            'forum_question_id!',
            'user_id',
        ];

        //primary key
        $this->primaryKey = 'forum_discussions_id';

    }

    /**
     * Gest list of items
     * @param type $params
     * @return object list of categories
     */
    public function selectItems($params = array())
    {

        //join to another tables
//        $params['join_table'] = 'forum_discussions';
//        $params['join_on'] = 'forum_questions_id';
        $elo = $this->joinTable($params);

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


    public function getComments($forum_id)
    {

        // Get post
        $params = array(
            'id' => $forum_id,
        );
        $post = $this->selectItem($params);

        // Get comment by context
        $params = array(
            'context_name' => 'post',
            'context_id' => $forum_id,
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
        $elo = $this;
        if (!empty($params['join_table']) && !empty($params['join_on'])) {
            $elo = $elo->join($params['join_table'], "{$this->table}.{$params['join_on']}", '=', "{$params['join_table']}.{$params['join_on']}");
        }
        return $elo;
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
                                $elo = $elo->where($this->table . '.created_user_id', '=', $value);
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
                                $elo = $elo->where($this->table . '.forum_id', '!=', $value);
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
                                    $elo->where($this->table . '.forum_questions_title', 'LIKE', "%{$value}%")
                                        ->orWhere($this->table . '.forum_questions_overview', 'LIKE', "%{$value}%")
                                        ->orWhere($this->table . '.forum_questions_description', 'LIKE', "%{$value}%");
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
            $this->table . '.forum_questions_id as id',
            DB::raw('(select count(*) from forum_discussions WHERE forum_discussions.forum_questions_id = forum_questions.forum_questions_id) as number_answers')
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
            if (!empty($dataFields['created_user_id'])) {
                unset($dataFields['created_user_id']);
            }
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

    public function countAnswerByQuestionId($qid) {
        $count = $this->where('forum_questions_id', '=', $qid)->count();
        return $count;
    }

    public function getAnswerByQuestionId($qid) {
        $answers = $this->where('forum_questions_id', '=', $qid)
                    ->orderBy('updated_at', 'desc')
                    ->get();
        return $answers;
    }
}
