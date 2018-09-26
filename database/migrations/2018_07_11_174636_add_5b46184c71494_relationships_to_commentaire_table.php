<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b46184c71494RelationshipsToCommentaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentaires', function(Blueprint $table) {
            if (!Schema::hasColumn('commentaires', 'article_id')) {
                $table->integer('article_id')->unsigned()->nullable();
                $table->foreign('article_id', '183278_5b4611955b32b')->references('id')->on('articles')->onDelete('cascade');
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
        Schema::table('commentaires', function(Blueprint $table) {
            
        });
    }
}
