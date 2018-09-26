<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1531317371CommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('commentaires')) {
            Schema::create('commentaires', function (Blueprint $table) {
                $table->increments('id');
                $table->string('pseudo')->nullable();
                $table->string('email')->nullable();
                $table->string('commentaire')->nullable();
                $table->integer('valider')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('commentaires');
    }
}
