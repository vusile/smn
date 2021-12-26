<?php

namespace App\Http\Controllers;

use App\Models\Dominika;
use App\Models\Song;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DominikaController extends Controller
{

    public function index()
    {
        $title = "Nyimbo za Dominika na Sikukuu Zilizoamriwa";
        $description = "Pata Nyimbo za Dominika na Sikukuu Zilizoamriwa";
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);

        $dominikas = Dominika::where(
                function($query) {
                    $query->whereIn('year_id', config('dominika.mwaka'))
                            ->orWhere('year_id', null);
                }

            )
            ->has('songs')
            ->whereDate('dominika_date', '>=', Carbon::today()->toDateString())
            ->orderBy('dominika_date')
            ->get();

        $ibadaZaWikiHii = Dominika::thisWeek()
            ->has('songs')
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
                ->where('approved', true)
                ->pluck('song_id')
                ->all();

        $katikati = $dominikaSongs
                ->where('parts_of_mass_id', 2)
                ->where('approved', true)
                ->pluck('song_id')
                ->all();

        $shangilio = $dominikaSongs
                ->where('parts_of_mass_id', 3)
                ->where('approved', true)
                ->pluck('song_id')
                ->all();

        $antifona = $dominikaSongs
                ->where('parts_of_mass_id', 4)
                ->where('approved', true)
                ->pluck('song_id')
                ->all();


        $approvedDominikaSongs = Song::approved()
                ->select('id', 'name', 'url', 'views', 'downloads', 'composer_id')
                ->with('composer:id,name')
                ->whereIn('id', $dominikaSongs->pluck('song_id')->all())
                ->orderBy('views')
                ->get();

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
