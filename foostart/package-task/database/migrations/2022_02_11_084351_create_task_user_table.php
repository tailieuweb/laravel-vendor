<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateTaskUserTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'task_user';
        $this->prefix_column = 'assignee_';
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

            // Other attributes
            $table->integer( 'user_id')->comment('User id');
            $table->integer( 'task_id')->comment('Task id');
            $table->text( 'notes')->nullable()->comment('Task notes');

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
