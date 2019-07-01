<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\DominikaCollection;
use App\Http\Resources\Collections\SongCollection;
use App\Models\Dominika;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DominikaController extends Controller
{
    
    public function index()
    {
        $dominikas = Dominika::where(
                function($query) {
                    $query->whereIn('year_id', config('dominika.mwaka'))
                            ->orWhere('year_id', null);
                }
                
            )
            ->whereDate('dominika_date', '>=', Carbon::today()->toDateString())
            ->orderBy('dominika_date')
            ->get();
            
        return new DominikaCollection($dominikas);
    }
    
    public function thisWeek()
    {
        return new DominikaCollection(
            Dominika::thisWeek()
                ->orderBy('dominika_date')
                ->get()
        );
    }
    
    public function show(Dominika $dominika)
    {   
        $dominikaSongs = DB::table('dominikas_songs')
                ->where('dominika_id', $dominika->id)
                ->get();
        
        $mwanzo = $dominikaSongs
                ->where('parts_of_mass_id', 1)
                ->pluck('song_id')
                ->all();
        
        $katikati = $dominikaSongs
                ->where('parts_of_mass_id', 2)
                ->pluck('song_id')
                ->all();
        
        $shangilio = $dominikaSongs
                ->where('parts_of_mass_id', 3)
                ->pluck('song_id')
                ->all();

        $antifona = $dominikaSongs
                ->where('parts_of_mass_id', 4)
                ->pluck('song_id')
                ->all();
        
        $approvedDominikaSongs = $dominika
                ->songs
                ->where('status', 1)
                ->sortBy('views');
         
        return [
            'mwanzo' => new SongCollection($approvedDominikaSongs->whereIn('id', $mwanzo)),
            'katikati' => new SongCollection($approvedDominikaSongs->whereIn('id', $katikati)),
            'shangilio' => new SongCollection($approvedDominikaSongs->whereIn('id', $shangilio)),
            'antifona' => new SongCollection($approvedDominikaSongs->whereIn('id', $antifona)),
        ];
    }
}
