<?php

namespace App\Listeners;

use App\Events\IthibatiApproved;
use App\Mail\IthibatiApprovedEmail;
use App\Mail\ComposerSongApprovedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendIthibatiApprovedEmail
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
    public function handle(IthibatiApproved $event)
    {
        $song = $event->song;
        
        $userMessage = (new IthibatiApprovedEmail($song))
                ->onQueue('songs');
        
        Mail::to($song->user->email)
            ->queue($userMessage);
        
        $composer = $song->composer;
        
        if ($composer->email && $composer->user_id != $song->user->id) {
            $composerMessage = (new IthibatiApprovedEmail($song))
                    ->onQueue('songs');
            
            Mail::to($song->composer->email)
                ->queue($composerMessage);
        }
    }
}
