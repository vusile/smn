<?php

namespace App\Http\Controllers;

use App\Models\MonthlySongStat;
use App\Models\Song;
use App\Models\SongView;
use App\Models\SongDownload;
use App\Services\SongService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jaybizzle\CrawlerDetect\CrawlerDetect;;

class SongController extends Controller
{
    /*
     * @var SongService
     */
    protected $songService;

    /*
     * @var CrawlerDetect
     */
    protected $crawlerDetect;

    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
        $this->crawlerDetect = new CrawlerDetect();
    }

    public function show(string $slug, Song $song)
    {
        $cacheName = "composer." . $song->composer_id;

        $composer = Cache::rememberForever($cacheName, function () use ($song) {
            return $song->composer;
        });

        SEOMeta::setTitle('Nota za ' . $song->name . ' na ' . $composer->name);
        SEOMeta::setDescription($song->description);

        $otherSongs = $this->songService->getOtherSongs($song);

        $parts = null;

        $dominikas = Cache::remember('song-has-dominikas.' . $song->id, 60*60*24*3, function () use ($song) {
            return $song->dominikas;
        });

        if($dominikas) {
            $parts = $this->songService->determinePartOfMass($song);
        }

        if(!$this->crawlerDetect->isCrawler()) {
            $songView = SongView::firstOrCreate(
                [
                    'viewed_on' => Carbon::now()->format('Y-m-d'),
                    'song_id' => $song->id
                ]
            );

            $monthlyStat = MonthlySongStat::firstOrCreate(
                [
                    'month' => date('m'),
                    'year' => date('Y'),
                    'song_id' => $song->id,
                ]
            );

            $monthlyStat->increment('views');
            $songView->increment('views');
            $song->increment('views');
        }

        return view(
            'songs.show',
            compact('song', 'otherSongs', 'parts')
        );
    }

    public function download(Song $song, string $type)
    {
        switch($type) {
            case 'midi':
                $path = storage_path('app/public/' . config('song.files.paths.midi') . $song->midi);
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Type: audio/midi");
                header("Content-Disposition: attachment; filename=". $song->midi);
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . filesize($path));
                readfile($path);
                exit;

            case 'pdf':
                if(!$this->crawlerDetect->isCrawler()) {
                    $songDownload = SongDownload::firstOrCreate(
                        ['downloaded_on' => Carbon::now()->format('Y-m-d'), 'song_id' => $song->id]
                    );

                    $monthlyStat = MonthlySongStat::firstOrCreate(
                        [
                            'month' => date('m'),
                            'year' => date('Y'),
                            'song_id' => $song->id,
                        ]
                    );

                    $monthlyStat->increment('downloads');
                    $songDownload->increment('downloads');
                    $song->increment('downloads');
                }

                if(!$song->ithibati_number || request('original')) {
                    $pdfName = $song->pdf;
                } else {
                    $pdfName = 'ithibati-' . $song->pdf;
                }

                return response()->file(
                    storage_path('app/public/' . config('song.files.paths.pdf') . $pdfName),
                    [
                        'Content-Disposition: attachment; filename="$pdfName"'
                    ]
                );

            case 'nota_original':
                $path = storage_path('app/public/' . config('song.files.paths.midi') . $song->nota_original);
                return Storage::download($path);

            case 'software_file':
                $path = storage_path('app/public/' . config('song.files.paths.midi') . $song->software_file);
                return Storage::download($path);
        }
    }
}
