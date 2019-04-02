<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\Song;
use App\Services\SearchService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $songs = $songs->filter(function($song){
                return in_array($song->status, [1,2,7,8]);
            });
            
            $composerNames = Composer::whereIn(
                    'id',
                    $songs->pluck('composer_id')->toArray()
                )
                ->pluck('name', 'id');
            
            $songsTotal = $songs->count();
        }
        
        return view(
            'search.index',
            compact(
                'songs',
                'composers',
                'composersTotal',
                'songsTotal',
                'composerNames'
            )
        );
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