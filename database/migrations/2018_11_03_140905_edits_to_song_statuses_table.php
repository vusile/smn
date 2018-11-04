<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditsToSongStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song_statuses', function (Blueprint $table) {
            $table->renameColumn('Title', 'title');
            $table->renameColumn('StatusID', 'id');
        });
        
        DB::table('song_statuses')
            ->insert(['id' => '4', 'title' => 'Pending']);
        
        DB::table('song_statuses')
            ->insert(['id' => '5', 'title' => 'Denied']);
        
        DB::table('songs')
            ->where('status', 0)
            ->update(['status' => 4]);    
        
        DB::table('song_statuses')
            ->where('id', 0)
            ->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('song_statuses', function (Blueprint $table) {
            //
        });
    }
}
