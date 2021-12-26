<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dominika;
use App\Models\Song;
use App\Services\SearchService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;

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
                'antifona'
            )
        );
    }

    public function delete(Request $request, Dominika $dominika) {

        if($request->get('delete')) {
            DB::table('dominikas_songs')
                ->where('dominika_id', $dominika->id)
                ->whereIn('song_id', $request->get('delete'))
                ->delete();
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
            ->search(request()->query('st'), 'songs');

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

        $songs = Song::take(5)
            ->get();

        $existingSongs = DB::table('dominikas_songs')
            ->where('dominika_id', $dominika->id)
            ->where('parts_of_mass_id', $partOfMassId)
            ->get()
            ->pluck('song_id')
            ->all();

        return view(
            'dominika.admin.update_songs',
            compact(
                'part', 'dominika', 'songs', 'partOfMassId', 'existingSongs'
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
}
