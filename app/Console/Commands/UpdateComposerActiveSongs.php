<?php

namespace App\Console\Commands;

use App\Models\Composer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateComposerActiveSongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'composers:update-active-songs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates composers active songs';

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
     */
    public function handle()
    {
        $query = "SELECT composers.*, composers.name name, composers.url url, COUNT( songs.id ) counts FROM songs, composers WHERE songs.composer_id = composers.id AND songs.status in (". implode( ",", config('song.show_in_site_statuses')) .") GROUP BY songs.composer_id ORDER BY composers.name";

        $activeSongs = DB::select($query);

        foreach($activeSongs as $activeSong) {
            Composer::where('id', $activeSong->id)
                ->update(
                    [
                        'active_songs' => $activeSong->counts
                    ]
                );
        }
    }
}
