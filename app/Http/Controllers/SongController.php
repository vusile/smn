<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\SongView;
use App\Models\SongDownload;
use App\Services\SongService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /*
     * @var SongService
     */
    protected $songService;
    
    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
    }
    
    public function show(string $slug, Song $song)
    {
        SEOMeta::setTitle('Nota za ' . $song->name . ' na ' . $song->composer->name);
        SEOMeta::setDescription($song->description);
        
        $otherSongs = $this->getOtherSongs($song);
        
        $parts = null;
        
        if($song->dominikas) {
            $parts = $this->songService->determinePartOfMass($song);
        }
        
        $songView = SongView::firstOrCreate(
            [
                'viewed_on' => Carbon::now()->format('Y-m-d'),
                'song_id' => $song->id
            ]
        );
        
        $songView->increment('views');
        
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
                header("Content-Disposition: attachment; filename='". $song->midi ."'");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . filesize($path));
                readfile($path);
                exit; 
            break;
            
            case 'pdf':
                $songDownload = SongDownload::firstOrCreate(
                    ['downloaded_on' => Carbon::now()->format('Y-m-d'), 'song_id' => $song->id]
                );

                $songDownload->increment('downloads');
                
                return response()->file(
                    storage_path('app/public/' . config('song.files.paths.pdf') . $song->pdf)
                );
                
                break;
            
            case 'original':
                $path = storage_path('app/public/' . config('song.files.paths.midi') . $song->nota_original);
                return Storage::download($path);
            break;
        
            case 'software':
                $path = storage_path('app/public/' . config('song.files.paths.midi') . $song->software_file);
                return Storage::download($path);
            break;
        }
    }
    
    protected function getOtherSongs(Song $song)
    {
        $otherSongs = null;
        
        $otherSongsCount = $song->composer->songs->count(); 
        
        if($otherSongsCount > 1) {
            $limit = ($otherSongsCount - 1) < 10 ? ($otherSongsCount - 1) : 10;  
            $otherSongs = $song
                ->composer
                ->songs
                ->filter(function ($value) use ($song) {
                    return $value->id != $song->id;
                })
                ->random($limit);
        }
        
        return $otherSongs;
    }
}
