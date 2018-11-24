<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDuplicateFlagToComposersTableAndSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('composers', function (Blueprint $table) {
            $table->boolean('duplicates_checked')->default(false);
        });
        
        Schema::table('songs', function (Blueprint $table) {
            $table->boolean('duplicates_checked')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('composers', function (Blueprint $table) {
            $table->dropColumn('duplicates_checked');
        });
        
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('duplicates_checked');
        });
    }
}
