<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateUserActiveSongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-active-songs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates users active songs';

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
        $query = "SELECT user_id, COUNT( songs.id ) counts FROM songs WHERE status in (1,2) GROUP BY user_id";  
        $activeSongs = DB::select($query);
        
        foreach($activeSongs as $activeSong) {
            User::where('id', $activeSong->user_id)
                ->update(
                    [
                        'active_songs' => $activeSong->counts
                    ]
                );
        }
    }
}
