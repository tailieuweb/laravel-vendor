<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateSiteStackoverflowTagsTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'site_stackoverflow_tags';
        $this->prefix_column = 'tag_';
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


            // Other attributes
            $table->string($this->prefix_column . 'name', 500)->comment('Name');
            $table->string($this->prefix_column . 'url', 255)->comment('Url');
            $table->text($this->prefix_column . 'overview')->nullable()->comment('Overview');
            $table->integer($this->prefix_column . 'num_questions')->nullable()->comment('Number questions');
            $table->string($this->prefix_column . 'other', 1000)->nullable()->comment('Other info');

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
