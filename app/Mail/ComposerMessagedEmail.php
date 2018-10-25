<?php

namespace App\Mail;

use App\Models\ComposerEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComposerMessagedEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $composerEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ComposerEmail $composerEmail)
    {
        $this->composerEmail = $composerEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Umepokea ujumbe kutoka kwa ' . $this->composerEmail->sender_name)
                ->replyTo($this->composerEmail->sender_email)
                ->view('emails.composer');
    }
}
