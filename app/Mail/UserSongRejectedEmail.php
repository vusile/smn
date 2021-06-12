<?php

namespace App\Mail;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UserSongRejectedEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $song;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $comments = [];
        
        $failedReviews = DB::table('reviews')
            ->join('review_questions', 'review_questions.id', '=', 'reviews.review_question_id')
            ->where('song_id', $this->song->id)
            ->where('review_answer_id', 2)
            ->get();   

        foreach($failedReviews as $failedReview) {
            
            if($failedReview->comment) {                
                $comment = '<strong>Pendekezo:</strong> ' .$failedReview->comment . "<br>";
                $comments[$failedReview->review_question_id] = $comment;     
            }
        }
        
        return $this->subject('Wimbo ' . $this->song->name . ' Haujawa Reviewed')
            ->view('emails.user-song-rejected')
            ->with(
                [
                    'song' => $this->song,
                    'failedReviews' => $failedReviews,
                    'comments' => $comments,
                ]
            );
    }
}
