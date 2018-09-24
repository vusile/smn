<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongCommentsUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('song_comments', function (Blueprint $table) {
            $table->renameColumn('Comment', 'comment');
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
            $table->renameColumn('comment', 'Comment');
        });
    }
}
