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
        $duplicates = Composer::where('duplicates_checked', false)
            ->take(20)
            ->get()
            ->each(function ($composer){
                $composer->duplicates_checked = true;
                $composer->save();
            })    
            ->filter(function ($composer) {
                return $this->composerService->checkForDuplicates($composer->name, false)->count() > 1;
            })
            ->mapWithKeys(function ($composer){
                return [
                    $composer->id => $this->composerService
                        ->checkForDuplicates($composer->name, false)
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
                && $request->input('composer-' . $composerId != 'ignore')
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
        }
        
        return redirect('duplicate-composers');
    }
}