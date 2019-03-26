<?php

namespace App\Services;

use App\Events\IthibatiApproved;
use App\Events\IthibatiRejected;
use App\Events\SongApproved;
use App\Events\SongRejected;
use App\Models\Song;
use App\Services\SearchService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SongService
{   
    protected $searchService;
    
    public function __construct(SearchService $searchService) {
        $this->searchService = $searchService;
    }
    public function determinePartOfMass(Song $song)
    {
        $dominikaPartsOfMass = DB::table('dominikas_songs')
                ->where('song_id', $song->id)
                ->get()
                ->mapWithKeys(function ($dominikaPartOfMass) {
                    $partOfMass = DB::table('parts_of_mass')
                            ->find($dominikaPartOfMass->parts_of_mass_id);

                    return [$dominikaPartOfMass->dominika_id => $partOfMass];
                });

        return $dominikaPartsOfMass->all();
    }
    
    public function similarSongsWithDominika(string $songName)
    {
        $similarSongs = $this->searchService
            ->search($songName, 'songs');
        
        $dominikas = collect();
        
        if($similarSongs) {
            $dominikas = Song::whereIn('id', $similarSongs->pluck('id'))
                ->get()
                ->filter(function ($song) {
                    return $song->dominikas->count() > 0;
                })
                ->map(function($song){
                    return $this->determinePartOfMass($song);
                })
                ->mapWithKeys(function ($item){
                    return $item;
                });
                
            return $dominikas;
        }
        
        return $dominikas;
    }
    
    public function approveSong(Song $song)
    {
        $song->status = 1;
        $song->approved_date = Carbon::now()->toDateString();
        $song->save();
        
        event(new SongApproved($song));
    }
    
    public function rejectSong(Song $song)
    {
        $song->status = 5;
        $song->save();
        
        event(new SongRejected($song));
    }
    
    public function notifyIthibati(Song $song, $approved = false)
    {
        $song->ithibati_notification_sent_date = Carbon::now()->format('Y-m-d');
        $song->save();
        
        if($approved) {
            echo "approved";
            event(new IthibatiApproved($song));
        }
        else {
            echo "denied";
            event(new IthibatiRejected($song));   
        }
    }
}