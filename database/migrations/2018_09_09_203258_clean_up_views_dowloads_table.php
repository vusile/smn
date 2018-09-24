<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanUpViewsDowloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song_downloads', function (Blueprint $table) {
            $table->renameColumn('DailyDownloadsID', 'id');
            $table->renameColumn('SongID', 'song_id');
            $table->renameColumn('Date', 'downloaded_on');
            $table->renameColumn('Downloads', 'downloads');
        });

        Schema::table('song_views', function (Blueprint $table) {
            $table->renameColumn('DailyViewsID', 'id');
            $table->renameColumn('SongID', 'song_id');
            $table->renameColumn('Date', 'viewed_on');
            $table->renameColumn('Views', 'views');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('song_downloads', function (Blueprint $table) {
            $table->renameColumn('id', 'DailyDownloadsID');
            $table->renameColumn('song_id', 'SongID');
            $table->renameColumn('downloaded_on', 'Date');
            $table->renameColumn('downloads', 'Downloads');
        });
        
        Schema::table('song_views', function (Blueprint $table) {
            $table->renameColumn('id', 'DailyViewsID');
            $table->renameColumn('song_id', 'SongID');
            $table->renameColumn('viewed_on', 'Date');
            $table->renameColumn('views', 'Views');
        });
    }
}
