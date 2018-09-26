<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b488dcb4d276ArticleTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('article_tag')) {
            Schema::create('article_tag', function (Blueprint $table) {
                $table->integer('article_id')->unsigned()->nullable();
                $table->foreign('article_id', 'fk_p_183262_183279_tag_ar_5b488dcb4d3da')->references('id')->on('articles')->onDelete('cascade');
                $table->integer('tag_id')->unsigned()->nullable();
                $table->foreign('tag_id', 'fk_p_183279_183262_articl_5b488dcb4d4d1')->references('id')->on('tags')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
    }
}
