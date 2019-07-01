<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\ComposerCollection;
use App\Http\Resources\Collections\SongCollection;
use App\Models\Composer;
use App\Models\Song;
use App\Services\SearchService;

class SearchController extends Controller
{
    /*
     * @var SearchService
     */
    protected $searchService;
    
    public function __construct(
        SearchService $searchService
    ) {
        $this->searchService = $searchService;
    }
    
    public function index()
    {
        $composersTotal = 0;
        $songsTotal = 0;
        $composers = $this->searchService
            ->search(request()->query('st'), 'composers');
        
        if($composers) {
            $composers = Composer::whereIn(
                'id',
                $composers->pluck('id')->toArray()
            )->get();
        }

        $songs = $this->searchService
            ->search(request()->query('st'), 'songs');

        if($songs) {
            $songs = $songs->filter(function($song){
                return in_array($song->status, [1,2,7,8]);
            });
            
            $songs = Song::whereIn(
                'id',
                $songs->pluck('id')->toArray()
            )
            ->sortBy('views')
            ->get();

        }
        
        return [
            'songs' => $songs ? new SongCollection($songs) : null,
            'composers' => $composers ? new ComposerCollection($composers) : null
        ];
    }
    
    public function searchUserSongs()
    {
        $songs = $this->searchService
            ->userSearch(request()->query('q'), 'songs');
        
        $status = 'Nyimbo Ulizotafuta';
        
        $songs = Song::whereIn(
                'id',
                $songs->pluck('id')->toArray()
            )
                ->paginate(20);
        
        return view(
            'account.songs',
            compact('songs', 'status')
        );
    }
}