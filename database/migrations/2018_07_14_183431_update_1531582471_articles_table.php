<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1531582471ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if(Schema::hasColumn('articles', 'redacteur_id')) {
                $table->dropForeign('183262_5b4a17601bcba');
                $table->dropIndex('183262_5b4a17601bcba');
                $table->dropColumn('redacteur_id');
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
        Schema::table('articles', function (Blueprint $table) {
                        
        });

    }
}
