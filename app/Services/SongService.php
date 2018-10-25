<?php

namespace App\Services;

use App\Models\Song;
use App\Services\SearchService;
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
        
        return null;
    }
}