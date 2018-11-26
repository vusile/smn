<?php

namespace App\Listeners;

use App\Events\SongCreated;
use App\Mail\UserSongCreatedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSongCreatedEmail
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
     * @param  SongCreated  $event
     * @return void
     */
    public function handle(SongCreated $event)
    {
        $song = $event->song;
        
//        Mail::to($song->user->email)
//            ->bcc('admin@swahilimusicnotes.com')
//            ->queue(new UserSongCreatedEmail($song));
        
    }
}
