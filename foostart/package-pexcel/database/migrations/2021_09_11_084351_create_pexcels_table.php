<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateCrawlerPatternsTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'pexcel_reader';
        $this->prefix_column = 'pexcel_reader_';
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
            $table->integer('category_id')->comment('Category ID');

            // Other attributes
            $table->string($this->prefix_column . 'name', 55)->comment('Name');
            $table->string($this->prefix_column . 'image', 55)->comment('Name');
            $table->string($this->prefix_column . 'file', 55)->comment('Name');
            $table->string($this->prefix_column . 'overview', 55)->comment('Machine name');
            $table->text($this->prefix_column . 'description')->nullable()->comment('Description');

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
