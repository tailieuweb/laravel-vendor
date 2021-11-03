<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateCrawlerWorksJobsTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'crawler_works_jobs';
        $this->prefix_column = 'job_';
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists($this->table);
        Schema::create($this->table, function (Blueprint $table) {

            $table->increments($this->prefix_column . 'id')->comment('Primary key');

            // Relation
            $table->integer('site_id')->comment('Site ID');

            // Other attributes
            $table->string($this->prefix_column . 'name', 255)->comment('Name');
            $table->string($this->prefix_column . 'url', 255)->comment('URL');
            $table->string($this->prefix_column . 'image', 255)->comment('Image');
            $table->string($this->prefix_column . 'overview', 500)->comment('Overview');
            $table->text($this->prefix_column . 'requirements')->comment('Requirements');
            $table->text($this->prefix_column . 'description')->comment('Description');

            //Set common columns
            $this->setCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
