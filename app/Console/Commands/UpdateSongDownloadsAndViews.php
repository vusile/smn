<?php

namespace App\Console\Commands;

use App\Models\Song;
use App\Models\SongDownload;
use App\Models\SongView;
use Illuminate\Console\Command;

class UpdateSongDownloadsAndViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'songs:update-downloads-and-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update song downloads and views';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
}
