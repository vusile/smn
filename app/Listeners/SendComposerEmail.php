<?php

namespace App\Listeners;

use App\Events\ComposerEmailCreated;
use App\Mail\ComposerMessagedEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendComposerEmail
{
    public $composerEmail;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  ComposerEmailSent  $event
     * @return void
     */
    public function handle(ComposerEmailCreated $event)
    {
        $composer = $event->composerEmail->composer;
        
        $sendTo = $composer->email;
        
        Mail::to($sendTo)
//            ->bcc('admin@swahilimusicnotes.com')
            ->queue(new ComposerMessagedEmail($event->composerEmail));
    }
}
