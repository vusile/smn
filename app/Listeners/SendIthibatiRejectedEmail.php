<?php

namespace App\Listeners;

use App\Events\IthibatiRejected;
use App\Mail\IthibatiRejectedEmail;
use Illuminate\Support\Facades\Mail;

class SendIthibatiRejectedEmail
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
    public function handle(IthibatiRejected $event)
    {
        $song = $event->song;

        $message = (new IthibatiRejectedEmail($song))
            ->onQueue('songs');

        Mail::to($song->user->email)
            ->bcc('vusile@gmail.com')
            ->queue($message);
    }
}
