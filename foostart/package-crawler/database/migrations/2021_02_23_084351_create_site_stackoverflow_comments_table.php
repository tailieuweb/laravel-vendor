<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateSiteStackoverflowCommentsTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'site_stackoverflow_comments';
        $this->prefix_column = 'comment_';
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
            $table->integer('context_id')->comment('Context ID');
            $table->string($this->prefix_column . 'type', 25)->comment('Context Name');

            // Other attributes
            $table->string($this->prefix_column . 'url_user', 255)->comment('URL user');
            $table->text($this->prefix_column . 'content')->comment('content');

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
