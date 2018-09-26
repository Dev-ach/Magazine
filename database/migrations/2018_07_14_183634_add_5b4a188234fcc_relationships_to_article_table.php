<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b4a188234fccRelationshipsToArticleTable extends Migration
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
                if (!Schema::hasColumn('articles', 'redacteur_id')) {
                $table->integer('redacteur_id')->unsigned()->nullable();
                $table->foreign('redacteur_id', '183262_5b4a17601bcba')->references('id')->on('users')->onDelete('cascade');
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
