<?php

namespace App\Http\Controllers;

use App\Models\Dominika;
use App\Models\Song;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
//        $smsService = new SmsService();
//        $smsService->sendOptions();

        $now = Carbon::now();

        $activeSongsCount = Cache::remember('active-songs', 3600, function () {
            return Song::approved()
                ->with('composer')
                ->count();
        });


        $recentSongs = Cache::remember('recent-songs', 3600, function () {
            return Song::approved()
                ->select('url', 'id', 'name', 'composer_id')
                ->with('composer:id,name')
                ->orderBy('approved_date', 'desc')
                ->limit(10)
                ->get();
        });

        $topTenSongs = Cache::remember('top-ten-songs', 60*60*24*3, function () {
            return Song::approved()
                ->with('composer')
                ->orderBy('downloads', 'desc')
                ->limit(10)
                ->get();
        });


        $weekly = Cache::remember('weekly-top-ten-ids', 60*60, function () use ($now) {
            return DB::select(
                "SELECT Sum(Downloads) as NumOfDownloads, song_id FROM song_downloads WHERE downloaded_on >= '" . $now->startOfWeek()->format('Y-m-d') . "' and downloaded_on <= '" . $now->endOfWeek()->format('Y-m-d') . "' GROUP BY song_id ORDER BY NumOfDownloads DESC LIMIT 10"
            );
        });

        $weeklySongIds = collect($weekly)
            ->pluck('song_id')
            ->toArray();

        $weeklyTopTenSongs = Cache::remember('weekly-top-ten-songs', 60*60, function () use ($weeklySongIds) {
            return Song::whereIn('id', $weeklySongIds)
                ->select('url', 'id', 'name', 'composer_id')
                ->with('composer:id,name')
                ->orderBy('approved_date', 'desc')
                ->orderBy('downloads', 'desc')
                ->approved()
                ->get();
        });

        $topTenUploaders = Cache::remember('top-ten-uploaders', 60*60*24*5, function () {
            return User::withCount('songs')
                ->orderBy('songs_count', 'desc')
                ->limit(10)
                ->get();
        });

        $ibadaZaWikiHii = Cache::remember('ibada-za-wiki', 60*60*24*5, function () {
             return Dominika::thisWeek()
                ->has('songs')
                ->select('title', 'id', 'dominika_date', 'rangi')
                ->orderBy('dominika_date')
                ->get();
        });

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

    public function missingPage() {
        return view(
            'errors.404'
        );
    }
}
