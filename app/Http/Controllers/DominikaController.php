<?php

namespace App\Http\Controllers;

use App\Models\Dominika;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DominikaController extends Controller
{
    
    public function index()
    {
        $title = "Nyimbo za Dominika na Sikukuu Zilizoamriwa";
        $description = "Pata Nyimbo za Dominika na Sikukuu Zilizoamriwa";
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        
        $dominikas = Dominika::where(
                'year_id',
                config('dominika.mwaka')
            )
            ->orWhere('year_id', null)
            ->orderBy('dominika_date')
            ->get();
        
        $ibadaZaWikiHii = Dominika::thisWeek()
            ->orderBy('dominika_date')
            ->get();
       
        return view(
            'dominika.index',
            compact(
                'dominikas',
                'title',
                'description',
                'ibadaZaWikiHii'
            )
        );
    }
    
    public function show(string $url, Dominika $dominika)
    {
        SEOMeta::setTitle($dominika->title);
        SEOMeta::setDescription(
            'Nyimbo za ' . $dominika->title
        );
        
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
                ->sortBy('name');
         
        return view(
            'dominika.show',
            compact(
                'approvedDominikaSongs',
                'dominika',
                'mwanzo',
                'katikati',
                'shangilio',
                'antifona'
            )
        );
    }
}
