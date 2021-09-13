<?php namespace Database\Seeders;

use Foostart\Acl\Library\Constants\FoostartConstants;
use Foostart\Category\Helpers\FoostartSeeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Foostart\Crawler\Models\Works\WorksCategories;
use Foostart\Crawler\Models\Works\WorksJobs;
use Foostart\Crawler\Models\Works\WorksCategoriesJobs;




class WorksSeeder extends FoostartSeeder
{
    public $obj_site;
    public $obj_re;
    public $obj_pattern;

    public function __construct() {
        // Table name
        $this->table = 'crawlers';
        // Prefix column
        $this->prefix_column = 'crawler_';

        $this->obj_works_jobs = new WorksJobs();
        $this->obj_works_categories = new WorksCategories();
        $this->obj_works_categories_jobs = new WorksCategoriesJobs();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->createSampleData();
    }

    /**
     * Create sample data for testing
     */
    private function createSampleData() {
        $isCreateSampleData =  env('DB_SAMPLE_TEST', FoostartConstants::IS_CREATE_SAMPLE_DATA);
        if ($isCreateSampleData == FoostartConstants::IS_CREATE_SAMPLE_DATA) {

            /**
             * crawler_works_jobs
             */
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $work_job = [
                    "site_id" => $i,
                    "job_name" => "job_name".$i,
                    "job_url" => "job_url_".$i,
                    "job_image" => "job_image_".$i,
                    "job_overview" => "job_overview_".$i,
                    "job_description" => "job_description_".$i,
                    "job_requirements" => "job_requirements_".$i,
                ];
                $this->obj_works_jobs->create($work_job);

            }

            /**
             * crawler_works_categories
             */
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $work_category = [
                    "site_id" => $i,
                    "category_name" => "category_name_".$i,
                    "category_url" => "category_url_".$i,
                    "category_image" => "category_image_".$i,
                    "category_overview" => "category_overview_".$i,
                    "category_description" => "category_description_".$i,
                ];
                $this->obj_works_categories->create($work_category);

            }

            /**
             * crawler_works_categories_jobs
             */
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $work_category_job = [
                    "category_id" => $i,
                    "job_id" => $i,

                ];
                $this->obj_works_categories_jobs->create($work_category_job);

            }
        }
    }
}
