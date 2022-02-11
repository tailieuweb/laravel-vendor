<?php namespace Database\Seeders;

use Foostart\Category\Helpers\FoostartSeeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends FoostartSeeder
{
    public function __construct()
    {
        // Table name
        $this->table = 'contexts';
        // Prefix column
        $this->prefix_column = 'context_';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->taskCreateContext();
    }

    private function taskCreateContext()
    {
        //Create context for user/level
        DB::table($this->table)->insert([
            $this->prefix_column . 'name' => 'Admin task',
            $this->prefix_column . 'key' => 'taskab7e417e2dddc5e5240b586d454e',
            $this->prefix_column . 'ref' => 'admin/task',
            'status' => 99,
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }


}
