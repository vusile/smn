<?php

namespace App\Console\Commands;

use App\Models\Song;
use App\Services\SongService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewSongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'review:songs {song?}';

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
        $songId = $this->argument('song');
        Song::pending()
           ->when($songId, function ($query, $songId){
               return $query->where('id', $songId);
           })
           ->chunk(50, function($songs){
               foreach ($songs as $song) {
                   $reviewsCount = DB::table('reviews')
                        ->groupBy('song_id')
                        ->groupBy('user_id')
                        ->where('song_id', $song->id)
                        ->count();
                 
                   
                   if ($reviewsCount >= config('song.reviews.no_of_reviews_per_song')) {
                       $approvalQuestionScores = DB::table('reviews')
                        ->select(DB::raw('count(*) as answers_count, review_question_id'))
                        ->groupBy('review_question_id')
                        ->where('song_id', $song->id)
                        ->where('review_answer_id', 1)
                        ->pluck('answers_count', 'review_question_id');
                       
                       $reject = false;
                       
                        if(!count($approvalQuestionScores)) {
                            $reject = true;
                        }
                        else {
                            $questions = DB::table('review_questions')
                                ->where('review_level', 1)    
                                ->when(!$song->midi, function($query) {
                                    return $query->where('mandatory', true);
                                })
                                ->get();
                                
                            foreach($questions as $question) {
                                if(
                                     $question->critical
                                     && $approvalQuestionScores[$question->id] < config('song.reviews.min_no_of_critical_reviews')
                                ) {
                                    $reject = true;
                                }
                            }
                            
                            
                        }
                        
                        if($reject) {
                            Log::info('song rejected - ' .$song->id);
                            $this->songService->rejectSong($song);
                        } else {                                
                            Log::info('song approved - ' .$song->id);
                            $this->songService->approveSong($song);
                        }
                   }
               }
           }
        );
    }
}
