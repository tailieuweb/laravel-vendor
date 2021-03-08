<?php namespace Database\Seeders;

use Foostart\Category\Helpers\FoostartSeeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModulesSeeder extends FoostartSeeder
{
    
    public function __construct() {
        // Table name
        $this->table = 'modules';
        // Prefix column
        $this->prefix_column = 'module_';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create context for user/level
        DB::table('contexts')->insert([
            $this->prefix_context . 'name' => 'Admin modules',
            $this->prefix_context . 'key' => 'abee417e2dddc5240b586d454e',
            $this->prefix_context . 'ref' => 'admin/modules',
            'status' => 99,
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
