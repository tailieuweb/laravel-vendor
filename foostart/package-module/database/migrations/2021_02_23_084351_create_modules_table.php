<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateModulesTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'modules';
        $this->prefix_column = 'module_';
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
            $table->integer('category_id')->nullable()->comment('Category ID');
            
            // Other attributes
            //Sender
            $table->string($this->prefix_column . 'name', 255)->comment('Name');
            $table->string($this->prefix_column . 'slug', 255)->comment('Slug');
            $table->text($this->prefix_column . 'description')->nullable()->comment('Description');
            $table->text($this->prefix_column . 'html')->comment('html');
            $table->text($this->prefix_column . 'css')->nullable()->comment('css');
            $table->text($this->prefix_column . 'javascript')->nullable()->comment('javascript');

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
