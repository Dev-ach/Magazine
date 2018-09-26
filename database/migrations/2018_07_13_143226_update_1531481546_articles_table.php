<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1531481546ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if(Schema::hasColumn('articles', 'tag_id')) {
                $table->dropForeign('183262_5b461120a8623');
                $table->dropIndex('183262_5b461120a8623');
                $table->dropColumn('tag_id');
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
