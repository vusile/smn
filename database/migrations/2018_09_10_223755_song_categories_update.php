<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongCategoriesUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song_categories', function (Blueprint $table) {
            $table->renameColumn('songID', 'song_id');
            $table->renameColumn('catID', 'category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('song_categories', function (Blueprint $table) {
            $table->renameColumn('song_id', 'songID');
            $table->renameColumn('category_id', 'catID');
        });
    }
}
