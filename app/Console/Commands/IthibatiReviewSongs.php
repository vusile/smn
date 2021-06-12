<?php

namespace App\Console\Commands;

use App\Models\Song;
use App\Services\SongService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IthibatiReviewSongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ithibati-review:songs {song?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ithibati Review Songs';
    
    /**
     *
     * @var SongService 
     */
    protected $songService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $songId = $this->argument('song');
        
        Song::withIthibati()
           ->whereNull('ithibati_notification_sent_date')
           ->when($songId, function ($query, $songId){
               return $query->where('id', $songId);
           })
           ->chunk(50, function($songs){
               foreach ($songs as $song) {
                   $this->songService->notifyIthibati($song, true);
               }
           }
        );
        
        Song::withNoIthibati()
           ->whereNull('ithibati_notification_sent_date')     
           ->when($songId, function ($query, $songId){
               return $query->where('id', $songId);
           })
           ->chunk(50, function($songs){
               foreach ($songs as $song) {
                   $this->songService->notifyIthibati($song);
               }
           }
        );
    }
}
