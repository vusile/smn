<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanupDatabase2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('song_views');
        Schema::dropIfExists('song_downloads');
        Schema::rename('daily_song_downloads', 'song_downloads');
        Schema::rename('daily_song_views', 'song_views');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('song_downloads', 'daily_song_downloads');
        Schema::rename('song_views', 'daily_song_views');
    }
}
