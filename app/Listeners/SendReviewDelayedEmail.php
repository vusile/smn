<?php

namespace App\Listeners;

use App\Events\SongReviewDelayed;
use App\Mail\UserSongReviewDelayedEmail;
use Illuminate\Support\Facades\Mail;

class SendReviewDelayedEmail
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
    public function handle(SongReviewDelayed $event)
    {
        $song = $event->song;
        
        $userMessage = (new UserSongReviewDelayedEmail($song))
                ->onQueue('songs');
        
        Mail::to($song->user->email)
            ->queue($userMessage);
    }
}
