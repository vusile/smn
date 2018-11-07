<?php

namespace App\Listeners;

use App\Events\SongRejected;
use App\Mail\UserSongRejectedEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendSongRejectedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SongRejected  $event
     * @return void
     */
    public function handle(SongRejected $event)
    {
        $song = $event->song;
        
        Mail::to($song->user->email)
            ->bcc('admin@swahilimusicnotes.com')
            ->queue(new UserSongRejectedEmail($song));
    }
}
