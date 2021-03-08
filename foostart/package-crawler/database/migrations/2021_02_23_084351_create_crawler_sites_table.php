<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Foostart\Category\Helpers\FoostartMigration;

class CreateCrawlerSitesTable extends FoostartMigration
{
    public function __construct() {
        $this->table = 'crawler_sites';
        $this->prefix_column = 'site_';
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
            $table->string($this->prefix_column . 'name', 255)->comment('Site name');
            $table->string($this->prefix_column . 'url', 255)->comment('Site url');
            $table->string($this->prefix_column . 'image', 255)->comment('Site image');
            $table->text($this->prefix_column . 'description')->comment('Description');
            
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
