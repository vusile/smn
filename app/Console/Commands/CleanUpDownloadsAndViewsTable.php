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
        $lastMonth = Carbon::now()->subDays(15)->format('Y-m-d');

        SongDownload::whereDate('downloaded_on', '<', $lastMonth)
                ->delete();
                
        SongView::whereDate('viewed_on', '<', $lastMonth)
            ->delete();
    }
}
