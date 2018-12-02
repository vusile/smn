<?php

namespace App\Listeners;

use App\Events\SongApproved;
use App\Mail\UserSongApprovedEmail;
use App\Mail\ComposerSongApprovedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSongApprovedEmail
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
     * @param  SongApproved  $event
     * @return void
     */
    public function handle(SongApproved $event)
    {
        $song = $event->song;
        
        Mail::to($song->user->email)
//            ->bcc('admin@swahilimusicnotes.com')
            ->queue(new UserSongApprovedEmail($song));
        
        if ($song->composer->email) {
            Mail::to($song->composer->email)
                ->bcc('admin@swahilimusicnotes.com')
                ->queue(new ComposerSongApprovedEmail($song));
        }
    }
}
