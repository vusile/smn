<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongCommentsCleanup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song_comments', function (Blueprint $table) {
            $table->dropColumn('Anonymous');
            $table->dropColumn('ReplyToCommentID');
            $table->renameColumn('Name', 'name');
            $table->renameColumn('Phone', 'phone');
            $table->renameColumn('Email', 'email');
            $table->renameColumn('CommentDate', 'comment_date');
            $table->renameColumn('UserID', 'user_id');
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
            $table->renameColumn('name', 'Name');
            $table->renameColumn('phone', 'Phone');
            $table->renameColumn('email', 'Email');
            $table->renameColumn('comment_date', 'CommentDate');
            $table->renameColumn('user_id', 'UserID');
        });
    }
}
