<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddSongStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('song_statuses')
            ->insert(['id' => '6', 'title' => 'Waiting for Ithibati']);

        DB::table('song_statuses')
            ->insert(['id' => '7', 'title' => 'Received Ithibati - For Recording']);

        DB::table('song_statuses')
            ->insert(['id' => '8', 'title' => 'Received Ithibati - Active on Site']);

        DB::table('song_statuses')
            ->insert(['id' => '9', 'title' => 'Denied Ithibati']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('song_statuses')
            ->where('id', 6)
            ->delete();

        DB::table('song_statuses')
            ->where('id', 7)
            ->delete();

        DB::table('song_statuses')
            ->where('id', 8)
            ->delete();

        DB::table('song_statuses')
            ->where('id', 9)
            ->delete();
    }
}
