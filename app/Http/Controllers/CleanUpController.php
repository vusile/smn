<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\Song;
use App\Services\ComposerService;
use App\Services\SongService;
use Illuminate\Http\Request;
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
    
    public function duplicateSongs()
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
                ->filter(function($composerDuplicate) use ($selectedComposer){
                    return $composerDuplicate != $selectedComposer;
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
}