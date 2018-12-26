<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentPostedEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $comment;
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, array $request)
    {
        $this->comment = $comment;
        $this->request = $request;
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
