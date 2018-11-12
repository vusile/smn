<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Support\Facades\DB;

class CleanUpController extends Controller
{
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
}