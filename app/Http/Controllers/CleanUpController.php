<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\Song;
use App\Models\SongDownload;
use App\Models\SongView;
use App\Services\ComposerService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CleanUpController extends Controller
{
    /**
     * @var ComposerService 
     */
    protected $composerService;
    
    /**
     * @var SongService 
     */
    protected $songService;
    
    public function __construct(
        ComposerService $composerService,
        SongService $songService
    ) {
        $this->composerService = $composerService;
        $this->songService = $songService;
    }
    public function missingCategories()
    {
        $ids = DB::table('song_categories')
            ->select('song_id')
            ->get()
            ->pluck('song_id');
        
        $songs = Song::whereNotIn('id', $ids)
            ->paginate(20);
        
        $status = 'Nyimbo zisizo na Category';
        
        return view(
            'account.songs',
            compact('songs', 'status')
        );
    }
    
    public function duplicateComposers()
    {
        $duplicates = DB::table('duplicates')
                ->where('entity_type', 'composer')
                ->limit(10)
                ->get()
                ->mapWithKeys(function ($duplicate){
                    return [
                        $duplicate->entity_id => Composer::whereIn(
                                'id',
                                explode(',', $duplicate->duplicates)
                            )
                            ->get()
                            ->sortByDesc('active_songs')
                    ];
                });
            
        $composerIds = $duplicates->keys()->implode(',');
            
        return view(
            'cleanup.composers.index',
            compact('duplicates', 'composerIds')
        );                
    }
    
    public function duplicateSongs()
    {
        $duplicates = DB::table('duplicates')
                ->where('entity_type', 'song')
                ->limit(10)
                ->get()
                ->mapWithKeys(function ($duplicate){
                    return [
                        $duplicate->entity_id => Song::whereIn(
                                'id',
                                explode(',', $duplicate->duplicates)
                            )
                            ->get()
                            ->sortByDesc('downloads')
                    ];
                });
            
        $songIds = $duplicates->keys()->implode(',');
            
        return view(
            'cleanup.songs.index',
            compact('duplicates', 'songIds')
        );                
    }
    
    public function removeDuplicateComposers(Request $request)
    {
        $composerIds = explode(',', $request->input('composer_ids'));

        foreach ($composerIds as $composerId) {
            if (
                $request->input('composer-' . $composerId)
                && $request->input('composer-' . $composerId) != 'ignore'
            ) {
                $selectedComposer = $request->input('composer-' . $composerId);
                $composerDuplicates = collect(
                    explode(
                        ',',
                        $request->input('composer-' . $composerId . '-duplicates')
                    )
                )
                ->filter(function($composerDuplicate) use ($selectedComposer, $request, $composerId){
                    return $composerDuplicate != $selectedComposer
                        && in_array($composerDuplicate, $request->input('include-composer' . $composerId));
                })
                ->toArray();
          
                Song::whereIn('composer_id', $composerDuplicates)
                    ->update(['composer_id' => $selectedComposer]);

                Composer::whereIn('id', $composerDuplicates)
                    ->delete();
            }
            
            DB::table('duplicates')
                ->where('entity_type', 'composer')
                ->where('entity_id', $composerId)
                ->delete();
        }
        
        return redirect('duplicate-composers');
    }
    
    public function removeDuplicateSongs(Request $request)
    {
        $songIds = explode(',', $request->input('song_ids'));

        foreach ($songIds as $songId) {
            if (
                $request->input('song-' . $songId)
                && $request->input('song-' . $songId) != 'ignore'
            ) {
                $selectedSong = $request->input('song-' . $songId);
                $songDuplicates = collect(
                    explode(
                        ',',
                        $request->input('song-' . $songId . '-duplicates')
                    )
                )
                ->filter(function($songDuplicate) use ($selectedSong, $request, $songId){
                    return ($songDuplicate != $selectedSong)
                        && in_array($songDuplicate, $request->input('include-song' . $songId));
                })
                ->toArray();
                
                $songDownloads = SongDownload::whereIn('song_id', $songDuplicates)
                    ->get();
                
                $songViews = SongView::whereIn('song_id', $songDuplicates)
                    ->get();
               
                $downloads = $songDownloads->sum('downloads');
                $views = $songViews->sum('views');
                
                SongView::firstOrCreate(
                    [
                        'viewed_on' => Carbon::now()->format('Y-m-d'),
                        'song_id' => $selectedSong,
                        'views' => $views
                    ]
                );
                
                SongDownload::firstOrCreate(
                    [
                        'downloaded_on' => Carbon::now()->format('Y-m-d'), 
                        'song_id' => $selectedSong,
                        'downloads' => $downloads
                    ]
                );
                
                Song::whereIn('id', $songDuplicates)
                    ->delete();
            }
            
            DB::table('duplicates')
                ->where('entity_type', 'song')
                ->where('entity_id', $songId)
                ->delete();
        }
        
        return redirect('duplicate-songs');
    }
}