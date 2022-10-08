<?php namespace Database\Seeders;

use Foostart\Branch\Models\LocationProvinces;
use Foostart\Category\Helpers\FoostartSeeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationSeeder extends FoostartSeeder
{
    private string $pathData;
    public function __construct()
    {
        // Table name
        $this->table = '';
        // Prefix column
        $this->prefix_column = 'location';

        $this->pathData = base_path() . '/vendor/foostart/package-branch/database/seeders/data';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate table before create sample data
        DB::table($this->prefix_table . 'provinces')->truncate();
        DB::table($this->prefix_table . 'districts')->truncate();
        DB::table($this->prefix_table . 'wards')->truncate();

        // Insert data
        $this->createProvincesData();
    }

    /**
     * Create provinces data
     */
    private function createProvincesData() {
        $pathData = $this->pathData . '/provinces.csv';
        $csvFile = fopen($pathData, "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LocationProvinces::create([
                    "code" => trim($data['0']),
                    "name" => trim($data['1']),
                    'status' => 99,
                    'created_user_id' => 1,
                    'updated_user_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }

    /**
     * Create districts data
     */
    private function createDistrictsData() {
        $pathData = $this->pathData . '/districts.csv';
        $csvFile = fopen($pathData, "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LocationProvinces::create([
                    "province_id" => trim($data['0']),
                    "code" => trim($data['1']),
                    "name" => trim($data['2']),
                    'status' => 99,
                    'created_user_id' => 1,
                    'updated_user_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }

    /**
     * Create wards data
     */
    private function createWardsData() {
        $pathData = $this->pathData . '/wards.csv';
        $csvFile = fopen($pathData, "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LocationProvinces::create([
                    "ward_id" => trim($data['0']),
                    "code" => trim($data['1']),
                    "name" => trim($data['2']),
                    'status' => 99,
                    'created_user_id' => 1,
                    'updated_user_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
