<?php

namespace App\Console\Commands;

use App\Models\SongDownload;
use App\Models\SongView;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CleanUpDownloadsAndViewsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean-up:downloads-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive';

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
        $lastMonth = Carbon::now()->subDays(30)->format('Y-m-d');
        $query = "INSERT INTO song_downloads_archive(song_id, downloaded_on, downloads) SELECT song_id, downloaded_on, downloads from song_downloads where downloaded_on < '" . $lastMonth . "'";
        
        DB::SELECT($query);

        SongDownload::whereDate('downloaded_on', '<', $lastMonth)
                ->delete();
        
         $query = "INSERT INTO song_views_archive(song_id, viewed_on, views) SELECT song_id, viewed_on, views from song_views where viewed_on < '" . $lastMonth . "'";
        
        DB::SELECT($query);
                
        SongView::whereDate('viewed_on', '<', $lastMonth)
            ->delete();
    }
}
