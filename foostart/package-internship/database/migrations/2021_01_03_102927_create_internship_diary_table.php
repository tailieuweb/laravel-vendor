<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateInternshipDiaryTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'internship_diary';
        $this->prefix_column = 'diary_';
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
            $table->integer('internship_id')->comment('Internship ID');

            // Other attributes
            $table->string($this->prefix_column . 'start_date', 255)->comment('Start date');
            $table->string($this->prefix_column . 'end_date', 255)->nullable()->comment('End date');
            $table->text($this->prefix_column . 'mon')->nullable()->comment('Mon');
            $table->text($this->prefix_column . 'tue')->nullable()->comment('Tue');
            $table->text($this->prefix_column . 'wed')->nullable('Wed');
            $table->text($this->prefix_column . 'thu')->nullable()->comment('Thu');
            $table->text($this->prefix_column . 'fri')->nullable()->comment('Fri');
            $table->text($this->prefix_column . 'sat')->nullable('Sat');
            $table->text($this->prefix_column . 'sun')->nullable('Sun');

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
