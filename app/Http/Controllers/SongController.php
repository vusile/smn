<?php

namespace App\Http\Controllers;

use App\Song;
use App\SongView;
use App\SongDownload;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    public function show(string $slug, Song $song)
    {
        SEOMeta::setTitle('Nota za ' . $song->name . ' na ' . $song->composer->name);
        SEOMeta::setDescription($song->description);
        
        $otherSongs = $this->getOtherSongs($song);
        
        $parts = null;
        
        if($song->dominikas) {
            $parts = $this->determinePartOfMass($song);
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
                $path = config('song.files.paths.midi') . $song->midi;
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
                
                return redirect(config('song.files.paths.pdf') . $song->pdf);
                
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
    
    protected function determinePartOfMass(Song $song)
    {
        $dominikaPartsOfMass = DB::table('dominikas_songs')
                ->where('song_id', $song->id)
                ->get()
                ->mapWithKeys(function ($dominikaPartOfMass) {
                    $partOfMass = DB::table('parts_of_mass')
                            ->find($dominikaPartOfMass->parts_of_mass_id);

                    return [$dominikaPartOfMass->dominika_id => $partOfMass->name];
                });

        return $dominikaPartsOfMass->all();
    }
}
