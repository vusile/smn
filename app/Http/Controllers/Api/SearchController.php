<?php

namespace App\Http\Controllers\Api;

//use App\Http\Resources\Collections\ComposerCollection;
use App\Http\Resources\SongCollection;
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
//        $composers = $this->searchService
//            ->search(request()->query('st'), 'composers');
//
//        if($composers) {
//            $composers = Composer::whereIn(
//                'id',
//                $composers->pluck('id')->toArray()
//            )->get();
//        }

        $composerId = request()->input('composer_id');
        $categoryId = request()->input('category_id');
        $searchTerm = request()->input('st');
        $songIds = array();

        if($searchTerm) {
            $sphinxResult = $this->searchService
                ->search(request()->input('st'), 'songs');
            $songIds = $sphinxResult->filter(function($song){
                return in_array($song->status, config('song.show_in_site_statuses'));
            });
        }

        $songs = Song::when($songIds, function($query) use ($songIds) {
                $query->whereIn('id', $songIds);
            })
            ->when($composerId, function($query) use ($composerId) {
                $query->where('composer_id', $composerId);
            })
            ->when($categoryId, function($query) use ($categoryId) {
                $query->category($categoryId);
            })
            ->orderBy('views')
            ->paginate();


        return $songs ? new SongCollection($songs) : null;
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
