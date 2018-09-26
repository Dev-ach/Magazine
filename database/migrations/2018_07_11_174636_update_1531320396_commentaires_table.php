<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1531320396CommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentaires', function (Blueprint $table) {
            if(Schema::hasColumn('commentaires', 'valider')) {
                $table->dropColumn('valider');
            }
            
        });
Schema::table('commentaires', function (Blueprint $table) {
            
if (!Schema::hasColumn('commentaires', 'valider')) {
                $table->tinyInteger('valider')->nullable()->default('0');
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
        Schema::table('commentaires', function (Blueprint $table) {
            $table->dropColumn('valider');
            
        });
Schema::table('commentaires', function (Blueprint $table) {
                        $table->integer('valider')->nullable();
                
        });

    }
}
