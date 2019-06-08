<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\Song;
use App\Services\SearchService;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
        /*
     * @var SongService
     */
    protected $songService;
    
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
            
            $composersTotal = $composers->count();
        }

        $songs = $this->searchService
            ->search(request()->query('st'), 'songs');
       
        if($songs) {            
            $songs = Song::whereIn(
                        'id',
                        $songs->pluck('id')->toArray()
                    )
                    ->where(function (Builder $query) {
                        $query->approved()->orWhere->forRecording();
                    })
                    ->get();
            
            $songsTotal = $songs->count();
        }
        
        return view(
            'search.index',
            compact('songs', 'composers', 'composersTotal', 'songsTotal')
        );
    }
    
    public function searchUserSongs()
    {
        if(auth()->user()->hasAnyRole(['super admin', 'admin'])){
            $songs = $this->searchService
                ->search(request()->query('q'), 'songs');
        } else {
            $songs = $this->searchService
                ->userSearch(request()->query('q'), 'songs');   
        }
        
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