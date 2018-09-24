<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongCommentsUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song_comments', function (Blueprint $table) {
            $table->renameColumn('SongID', 'song_id');
            $table->renameColumn('CommentID', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('song_comments', function (Blueprint $table) {
            $table->renameColumn('song_id', 'SongID');
            $table->renameColumn('id', 'CommentID');
        });
    }
}
