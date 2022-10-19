<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MonthlyDownloads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_song_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('song_id');
            $table->integer('month');
            $table->integer('year');
            $table->bigInteger('downloads');
            $table->bigInteger('views');
            $table->foreign('song_id')->references('id')->on('songs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_song_stats');
    }
}
