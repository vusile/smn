<?php

namespace App\Console\Commands;

use App\Models\Song;
use App\Services\SongService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ReviewSongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'review:songs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Review Songs';
    
    /**
     *
     * @var SongService 
     */
    protected $songService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Song::pending()
           ->chunk(50, function($songs){
               foreach ($songs as $song) {
                   $reviewsCount = DB::table('reviews')
                        ->groupBy('song_id')
                        ->groupBy('user_id')
                        ->where('song_id', $song->id)
                        ->count();
                   
                   $mandatoryQuestions = DB::table('review_questions')
                           ->where('mandatory', true)
                           ->count();
                   
                    if ($song->midi) {
                       $questions = DB::table('review_questions')
                           ->get();
                    } else {
                       $questions = DB::table('review_questions')
                           ->where('mandatory', true)
                           ->get();
                    }
                   
                   if ($reviewsCount >= config('song.reviews.no_of_reviews_per_song')) {
                       $approvalQuestionScores = DB::table('reviews')
                        ->select(DB::raw('count(*) as answers_count, review_question_id'))
                        ->groupBy('review_question_id')
                        ->where('song_id', $song->id)
                        ->where('review_answer_id', 1)
                        ->get();
                       
                       dd($approvalQuestionScores);
                       
                       if ($approvals / $reviewsCount >= config('song.reviews.percentage')){
                           $this->songService->approveSong($song);
                       } else {
                           $this->songService->rejectSong($song);
                       }
                   }
               }
           }
        );
    }
}
