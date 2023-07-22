<?php

namespace App\Services;

use App\Events\IthibatiApproved;
use App\Events\IthibatiRejected;
use App\Events\SongApproved;
use App\Events\SongRejected;
use App\Models\Song;
use App\Services\SearchService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SongService
{
    protected $searchService;

    public function __construct(SearchService $searchService) {
        $this->searchService = $searchService;
    }
    public function determinePartOfMass(Song $song)
    {
        $dominikaPartsOfMass = Cache::remember('song-dominikas.' . $song->id, 60*60*24*3, function () use ($song) {
            return DB::table('dominikas_songs')
                ->where('song_id', $song->id)
                ->get()
                ->mapWithKeys(function ($dominikaPartOfMass) {
                    $partOfMass = DB::table('parts_of_mass')
                        ->find($dominikaPartOfMass->parts_of_mass_id);

                    return [$dominikaPartOfMass->dominika_id => $partOfMass];
                });
        });

        return $dominikaPartsOfMass->all();
    }

    public function similarSongsWithDominika(string $songName)
    {
        $similarSongs = $this->searchService
            ->search($songName, 'songs');

        $dominikas = collect();

        if($similarSongs) {
            $dominikas = Song::whereIn('id', $similarSongs->pluck('id'))
                ->get()
                ->filter(function ($song) {
                    return $song->dominikas->count() > 0;
                })
                ->map(function($song){
                    return $this->determinePartOfMass($song);
                })
                ->mapWithKeys(function ($item){
                    return $item;
                });

            return $dominikas;
        }

        return $dominikas;
    }

    public function approveSong(Song $song)
    {
        if($this->isVerifiedByComposer($song)) {
            $song->status = config('song.statuses.approved_and_verified');
        } else {
            $song->status = config('song.statuses.approved');
        }
        $song->approved_date = Carbon::now()->toDateString();
        $song->save();

        event(new SongApproved($song));
    }

    private function isVerifiedByComposer(Song $song)
    {
        return $song->composer()->user_id == $song->user()->id
            || in_array(
                $song->user->id,
                $song->composer()->helpers()->get()->pluck('id')->toArray()
            );
    }

    public function rejectSong(Song $song)
    {
        $song->status = config('song.statuses.denied');
        $song->save();

        event(new SongRejected($song));
    }

    public function getOtherSongs(Song $song)
    {
        $otherSongs = null;
        $otherSongsCount = $song
                ->composer
                ->songs
                ->filter(function ($value) use ($song) {
                    return ($value->id != $song->id) && ($value->status == 1);
                })
                ->count();

        if($otherSongsCount > 1) {
            $limit = $otherSongsCount < 10 ? 0 : 10;
            $otherSongs = $song
                ->composer
                ->songs
                ->filter(function ($value) use ($song) {
                    return ($value->id != $song->id) && ($value->status == 1);
                })
                ->when($limit, function ($query) use ($limit) {
                    return $query->random($limit);
                });
        }

        return $otherSongs;
    }

    public function notifyIthibati(Song $song, $approved = false)
    {
        $song->ithibati_notification_sent_date = Carbon::now()->format('Y-m-d');
        $song->save();

        if($approved) {
            echo "approved";
            event(new IthibatiApproved($song));
        }
        else {
            echo "denied";
            event(new IthibatiRejected($song));
        }
    }
}
