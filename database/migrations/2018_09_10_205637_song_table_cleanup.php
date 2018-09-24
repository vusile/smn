<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongTableCleanup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('uploaded_by', 'user_id');
            $table->renameColumn('approved', 'status');
            $table->dropForeign('songs_approved_by_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('user_id', 'uploaded_by');
            $table->renameColumn('status', 'approved');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }
}
