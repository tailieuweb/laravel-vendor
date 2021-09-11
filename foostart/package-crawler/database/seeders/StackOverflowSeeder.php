<?php namespace Database\Seeders;

use Foostart\Acl\Library\Constants\FoostartConstants;
use Foostart\Category\Helpers\FoostartSeeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Foostart\Crawler\Models\Sites;
use Foostart\Crawler\Models\RegularExpressions;
use Foostart\Crawler\Models\Patterns;


class StackOverflowSeeder extends FoostartSeeder
{
    public $obj_site;
    public $obj_re;
    public $obj_pattern;

    public function __construct() {
        // Table name
        $this->table = 'crawlers';
        // Prefix column
        $this->prefix_column = 'crawler_';

        $this->obj_site = new Sites();
        $this->obj_pattern = new Patterns();
        $this->obj_re = new RegularExpressions();
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
            $this->prefix_context . 'name' => 'Admin crawlers',
            $this->prefix_context . 'key' => 'abee417e2dddc5240b586d454e',
            $this->prefix_context . 'ref' => 'admin/crawlers',
            'status' => 99,
            'created_user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $this->call('Foostart\Acl\Database\PermissionSeeder');
        $this->call('Foostart\Acl\Database\GroupsSeeder');
        $this->call('Foostart\Acl\Database\UserSeeder');

        $this->createSampleData();
    }

    /**
     * Create sample data for testing
     */
    private function createSampleData() {
        $isCreateSampleData =  env('DB_SAMPLE_TEST', FoostartConstants::IS_CREATE_SAMPLE_DATA);
        if ($isCreateSampleData == FoostartConstants::IS_CREATE_SAMPLE_DATA) {

            /**
             * crawler_sites
             */
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $site = [
                    "site_name" => "site_name".$i,
                    "site_slug" => "site_slug_".$i,
                    "site_url" => "site_url_".$i,
                    "site_type" => $i,
                    "site_description" => "site_description_".$i,
                ];
                $this->obj_site->create($site);

            }

            /**
             * crawler_patterns
             */
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $pattern = [
                    "site_id" => $i,
                    "pattern_name" => "pattern_name_".$i,
                    "pattern_machine_name" => "pattern_machine_name_".$i,
                    "pattern_description" => "pattern_description_".$i,
                ];
                $this->obj_pattern->create($pattern);

            }

            /**
             * crawler_regular_expressions
             */
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $re = [
                    "pattern_id" => $i,
                    "regular_expression_value" => "pattern_name_".$i,
                ];
                $this->obj_re->create($re);

            }
        }
    }
}
