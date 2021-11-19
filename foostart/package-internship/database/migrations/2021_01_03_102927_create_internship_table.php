<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateInternshipTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'internship';
        $this->prefix_column_company = 'company_';
        $this->prefix_column = 'internship_';
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
            $table->integer('course_id')->comment('Course ID');
            $table->integer('user_id')->comment('User ID');
            $table->integer('category_id')->comment('Category ID');

            // Other attributes
            $table->string( 'student_class', 255)->comment('Student class');

            $table->string($this->prefix_column_company . 'name', 255)->comment('Company name');
            $table->string($this->prefix_column_company . 'phone', 255)->nullable()->comment('Company phone');
            $table->string($this->prefix_column_company . 'instructor', 255)->nullable()->comment('Company instructor');
            $table->string($this->prefix_column_company . 'instructor_phone', 255)->nullable()->comment('Company internship name');
            $table->string($this->prefix_column_company . 'slug', 255)->comment('Company slug');
            $table->string($this->prefix_column_company . 'website', 255)->nullable()->nullable()->comment('Company website');
            $table->string($this->prefix_column_company . 'tax_code', 255)->nullable()->nullable()->comment('Company tax code');
            $table->string($this->prefix_column_company . 'address', 500)->comment('Company address');

            $table->string($this->prefix_column_company . 'image', 255)->nullable()->comment('Company image');
            $table->text($this->prefix_column_company . 'description')->nullable()->comment('Company description');

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
