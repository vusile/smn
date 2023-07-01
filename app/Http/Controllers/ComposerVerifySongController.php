<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class ComposerVerifySongController extends Controller
{
    public function verifySong(Song $song)
    {
        $song->status = config('song.statuses.approved_and_verified');
        $song->save();

        //todo: send notification
        return redirect()
            ->back()
            ->with('message', 'Umefanikiwa ku-hakiki wimbo!');
    }

    public function denySong(Song $song)
    {
        $song->status = config('song.statuses.redraw');
        $song->save();

        //todo: send notification

        return redirect()
            ->back()
            ->with('message', 'Umefanikiwa ku-ondoa wimbo!');
    }
}
