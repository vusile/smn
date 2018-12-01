<?php

use App\Models\Song;
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
        $songs = Song::approved()
            ->where('views', 0)
            ->get();
        
        $count = $songs->count();
        
        foreach($songs as $song) {
            $songView = SongView::selectRaw('sum(views) as views')
                ->where('song_id', $song->id)
                ->first();
            
            $song->views = $songView->views;
            $song->save();
                    
            $count = $count - 1;
            echo $count . '<br>';
        }
//        SongView::selectRaw('sum(views) as views, song_id')
//            ->groupBy('song_id')
//            ->chunk(100, function ($songViews) {
//                foreach($songViews as $songView)
//                {
//                    Song::where('id', $songView->song_id)
//                        ->update(
//                            [
//                                'views' => $songView->views
//                            ]
//                        );
//                }
//            });
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
