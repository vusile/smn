<?php

namespace App\Http\Controllers;

use App\Models\Dominika;
use App\Models\Song;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {        
        $now = Carbon::now();
        
        $activeSongsCount = Song::approved()
            ->count();
        
        $recentSongs = Song::approved()
            ->orderBy('approved_date', 'desc')
            ->limit(10)
            ->get();
        
        $topTenSongs = Song::approved()
            ->orderBy('downloads', 'desc')
            ->limit(10)
            ->get();
        
         $weekly = DB::select("SELECT Sum(Downloads) as NumOfDownloads, song_id FROM song_downloads WHERE downloaded_on >= '" . $now->startOfWeek()->format('Y-m-d') . "' and downloaded_on <= '" . $now->endOfWeek()->format('Y-m-d') . "' GROUP BY song_id ORDER BY NumOfDownloads DESC LIMIT 10");
         
        
        $weeklySongIds = collect($weekly)
            ->pluck('song_id')
            ->toArray();
                
        $weeklyTopTenSongs = Song::whereIn('id', $weeklySongIds)
            ->orderBy('downloads', 'desc')    
            ->approved()
            ->get();
           
        $topTenUploaders = User::withCount('songs')
                ->orderBy('songs_count', 'desc')
                ->limit(10)
                ->get();
        
        $ibadaZaWikiHii = Dominika::thisWeek()
            ->get();
        
        return view(
            'home.index',
            compact(
                'recentSongs',
                'topTenSongs',
                'weeklyTopTenSongs',
                'activeSongsCount',
                'topTenUploaders',
                'ibadaZaWikiHii'
            )
        );
       
    }
}
