<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Foostart\Category\Helpers\FoostartMigration;

class CreateDiscussionTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'forum_discussions';
        $this->prefix_column = 'forum_discussions_';
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
            $table->integer('forum_questions_id')->comment('Question ID');

            // Other attributes
            $table->text($this->prefix_column . 'description')->comment('Answer for question');
            $table->string($this->prefix_column . 'files', 1000)->nullable()->comment('The list of attachment filenames');
            $table->boolean('is_best_answer')->default(0);
            //Set common columns
            $table->integer('version')->unsigned()->default('1')->comment('Versioning');
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
