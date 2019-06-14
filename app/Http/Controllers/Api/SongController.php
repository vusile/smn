<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\SongCollection;
use App\Http\Resources\Song as SongResource;
use App\Models\Song;
use App\Models\SongView;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /*
     * @var SongService
     */
    protected $songService;
    
    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
    }
    
    public function show(Song $song)
    {
        $parts = null;
        
        if($song->dominikas) {
            $parts = $this->songService->determinePartOfMass($song);
        }
        
        $songView = SongView::firstOrCreate(
            [
                'viewed_on' => Carbon::now()->format('Y-m-d'),
                'song_id' => $song->id
            ]
        );
        
        $songView->increment('views');
        $song->increment('views');

        return new SongResource($song);
    }
    
    public function otherSongs(Song $song)
    {
        return new SongCollection(
            $this->songService->getOtherSongs($song)
        );
    }
}
