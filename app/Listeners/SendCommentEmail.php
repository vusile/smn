<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Mail\CommentPostedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCommentEmail
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
     * @param  CommentPosted  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        $song = $event->comment->song;
        $data = $event->request;
        
        $sendTo = $song->user->email;
        
        if ($song->composer->email) {
            $sendTo = [
                $song->composer->email,
                $song->user->email
            ];
        }
        
        $message = (new CommentPostedEmail($event->comment, $data))
                ->onQueue('general');
        
        Mail::to($sendTo)
            ->queue($message);
    }
} 
