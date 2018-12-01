<?php

use App\Models\Song;
use App\Models\SongDownload;
use App\Models\SongView;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongViewsAndDownloads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->bigInteger('downloads')->default(0);
            $table->bigInteger('views')->default(0);
        });
        
        SongDownload::selectRaw('sum(downloads) as downloads, song_id')
            ->groupBy('song_id')
            ->chunk(100, function ($songDownloads) {
                foreach($songDownloads as $songDownload)
                {
                    Song::where('id', $songDownload->song_id)
                        ->update(
                            [
                                'downloads' => $songDownload->downloads
                            ]
                        );
                }
            });
            
        SongView::selectRaw('sum(views) as views, song_id')
            ->groupBy('song_id')
            ->chunk(100, function ($songViews) {
                foreach($songViews as $songView)
                {
                    Song::where('id', $songView->song_id)
                        ->update(
                            [
                                'views' => $songView->views
                            ]
                        );
                }
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
            $table->dropColumn(['downloads', 'views']);
        });
    }
}
