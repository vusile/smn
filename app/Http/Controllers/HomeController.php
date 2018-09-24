<?php

namespace App\Http\Controllers;

use App\Dominika;
use App\Song;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        
        $topTenSongs = Song::withCount('songDownloads')
            ->orderBy('song_downloads_count', 'desc')
            ->limit(10)
            ->approved()
            ->get();
        
        $weeklyTopTenSongs = Song::withCount(['songDownloads' => function ($query) use ($now) {
                    $query->whereBetween(
                        'downloaded_on', 
                        [
                            $now->startOfWeek()->format('Y-m-d'),
                            $now->endOfWeek()->format('Y-m-d')
                        ]
                    );
                }
            ])
            ->orderBy('song_downloads_count', 'desc')
            ->limit(10)
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
