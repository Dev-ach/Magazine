<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1531320307ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if(Schema::hasColumn('articles', 'contenue')) {
                $table->dropColumn('contenue');
            }
            if(Schema::hasColumn('articles', 'publier')) {
                $table->dropColumn('publier');
            }
            
        });
Schema::table('articles', function (Blueprint $table) {
            
if (!Schema::hasColumn('articles', 'contenue')) {
                $table->text('contenue')->nullable();
                }
if (!Schema::hasColumn('articles', 'publier')) {
                $table->tinyInteger('publier')->nullable()->default('0');
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
            $table->dropColumn('contenue');
            $table->dropColumn('publier');
            
        });
Schema::table('articles', function (Blueprint $table) {
                        $table->string('contenue')->nullable();
                $table->integer('publier')->nullable();
                
        });

    }
}
