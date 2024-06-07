<?php namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Foostart\Category\Helpers\FoostartSeeder;

class QASeeder extends FoostartSeeder
{
    private $obj_pexcel;

    public function __construct() {
        // Table name
        $this->table = 'forum_questions';
        // Prefix column
        $this->prefix_column = 'forum_questions_';

    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create sample data
        DB::table('contexts')->insert([
            $this->prefix_context . 'name' => 'Admin forums',
            $this->prefix_context . 'key' => md5('admin/forums'),
            $this->prefix_context . 'ref' => 'admin/forums',
            'status' => 99,
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
