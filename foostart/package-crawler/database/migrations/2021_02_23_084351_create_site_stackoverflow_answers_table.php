<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateSiteStackoverflowAnswersTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'site_stackoverflow_answers';
        $this->prefix_column = 'answer_';
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
            $table->integer('question_id')->comment('Question ID');

            // Other attributes
            $table->text($this->prefix_column . 'description')->comment('Description');
            $table->string($this->prefix_column . 'url_user', 255)->comment('URL user');

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
