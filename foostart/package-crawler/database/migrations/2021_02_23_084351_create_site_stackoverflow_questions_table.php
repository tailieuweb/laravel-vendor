<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateSiteStackoverflowQuestionsTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'site_stackoverflow_questions';
        $this->prefix_column = 'question_';
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
            $table->string($this->prefix_column . 'name', 255)->comment('Name');
            $table->string($this->prefix_column . 'url', 255)->comment('URL');
            $table->text($this->prefix_column . 'description')->comment('Description');
            $table->string($this->prefix_column . 'url_user', 55)->comment('URL user');

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
