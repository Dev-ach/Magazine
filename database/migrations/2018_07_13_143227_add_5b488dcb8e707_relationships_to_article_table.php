<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b488dcb8e707RelationshipsToArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function(Blueprint $table) {
            if (!Schema::hasColumn('articles', 'categories_id')) {
                $table->integer('categories_id')->unsigned()->nullable();
                $table->foreign('categories_id', '183262_5b4610a823dd3')->references('id')->on('categories')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function(Blueprint $table) {
            
        });
    }
}
