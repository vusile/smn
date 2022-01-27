<?php

namespace App\Http\Controllers\Admin;

use App\Models\Composer;
use App\Models\Dominika;
use App\Models\Song;
use App\Services\SearchService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DominikaController extends Controller
{
    /*
 * @var SearchService
 */
    protected SearchService $searchService;

    public function __construct(
        SearchService $searchService
    ) {
        $this->searchService = $searchService;
    }

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
            ->whereYear('dominika_date', '>=', Carbon::today()->year())
            ->orderBy('dominika_date')
            ->get();

        $ibadaZaWikiHii = Dominika::thisWeek()
            ->orderBy('dominika_date')
            ->get();

        return view(
            'dominika.admin.index',
            compact(
                'dominikas',
                'title',
                'description',
                'ibadaZaWikiHii'
            )
        );
    }

    public function show(Dominika $dominika)
    {
        SEOMeta::setTitle($dominika->title);
        SEOMeta::setDescription(
            'Nyimbo za ' . $dominika->title
        );

        $dominikaSongs = DB::table('dominikas_songs')
                ->where('dominika_id', $dominika->id)
                ->get();

        $statuses = $dominikaSongs->pluck('approved', 'song_id');

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

        $approvedDominikaSongs = Song::approved()
                ->select('id', 'name', 'url', 'views', 'downloads', 'composer_id')
                ->with('composer:id,name')
                ->whereIn('id', $dominikaSongs->pluck('song_id')->all())
                ->orderBy('views')
                ->get();

        return view(
            'dominika.admin.show',
            compact(
                'approvedDominikaSongs',
                'dominika',
                'mwanzo',
                'katikati',
                'shangilio',
                'antifona',
                'statuses'
            )
        );
    }

    public function changeStatus(Request $request, Dominika $dominika) {
        if($request->submit == "delete") {
            DB::table('dominikas_songs')
                ->where('dominika_id', $dominika->id)
                ->where('parts_of_mass_id', $request->get('parts_of_mass_id'))
                ->whereIn('song_id', $request->get('changeStatus'))
                ->delete();


            DB::table('dominikas_songs')
                ->where('parts_of_mass_id', $request->get('parts_of_mass_id'))
                ->where('dominika_id', $dominika->id)
                ->update(['approved' => true]);
        } else {
            DB::table('dominikas_songs')
                ->where('parts_of_mass_id', $request->get('parts_of_mass_id'))
                ->where('dominika_id', $dominika->id)
                ->whereIn('song_id', $request->get('changeStatus'))
                ->update(['approved' => true]);
        }

        return back();
    }

    public function update_date(Request $request, Dominika $dominika) {
        $dominika->dominika_date = $request->get('dominika_date');
        $dominika->save();
        return back();
    }

    public function add_songs(string $part, Dominika $dominika) {
        return view(
            'dominika.admin.add_songs',
            compact(
                'part', 'dominika'
            )
        );
    }
    public function search() {
        $songs = $this->searchService
            ->search(request()->query('q'), 'songs');

        $composerNames = [];

        if($songs) {
            $composerNames = Composer::whereIn(
                'id',
                $songs->pluck('composer_id')->toArray()
            )
                ->pluck('name', 'id');
        }

        $part = request()->query('part');
        $dominika = Dominika::find(request()->query('dominika'));
        $partOfMassId = "";

        switch($part) {
            case 'mwanzo':
                $partOfMassId = 1;
                break;

            case 'katikati':
                $partOfMassId = 2;
                break;

            case 'shangilio':
                $partOfMassId = 3;
                break;

            case 'antifona':
                $partOfMassId = 4;
                break;
        }

        $existingSongs = DB::table('dominikas_songs')
            ->where('dominika_id', $dominika->id)
            ->where('parts_of_mass_id', $partOfMassId)
            ->get()
            ->pluck('song_id')
            ->all();

        return view(
            'dominika.admin.update_songs',
            compact(
                'part', 'dominika', 'songs', 'partOfMassId', 'existingSongs', 'composerNames'
            )
        );
    }


    public function update_songs(Request $request, Dominika $dominika) {

        if($request->get('update')) {
            $updates = [];
            foreach($request->get('update') as $song) {
                $updates[] = [
                    'dominika_id' => $dominika->id,
                    'song_id' => $song,
                    'parts_of_mass_id' => $request->get('part_of_mass_id'),
                    'approved' => true
                ];
            }
            DB::table('dominikas_songs')
                ->insert($updates);
        }

        return redirect("/admin/dominikas/" . $dominika->id);
    }

    public function reviewDominika() {
        $songIds = DB::table("dominikas_songs")
            ->where('approved', false)
            ->get()
            ->pluck('song_id');

        $songs = Song::whereIn('id', $songIds)
            ->get();

        $partsOfMass = [
            1 => 'Mwanzo',
            2 => 'Katikati',
            3 => 'Shangilio',
            4 => 'Antifona'
        ];

        return view(
            'dominika.admin.review',
            compact(
                'songs', 'partsOfMass'
            )
        );
    }

    public function changeDominikaStatus(string $status, Song $song, Dominika $dominika) {
        switch ($status) {
            case 'approve':
                DB::table('dominikas_songs')
                    ->where('song_id', $song->id)
                    ->where('dominika_id', $dominika->id)
                    ->update(['approved' => true]);
                break;

            case 'deny':
                DB::table('dominikas_songs')
                    ->where('song_id', $song->id)
                    ->where('dominika_id', $dominika->id)
                    ->delete();
                break;
        }

        return redirect()->back();
    }
}
