<?php

namespace App\Mail;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentPostedEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Umepokea maoni yafuatayo kwenye wimbo ' . $this->comment->song->name)
                ->replyTo($this->comment->email)
                ->view('emails.comment');
    }
}
