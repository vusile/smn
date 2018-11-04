<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReviewSongs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $reviewedToday = DB::table('reviews')
            ->where('user_id', auth()->user()->id)
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->groupBy('song_id')
            ->get();
        
        if ($reviewedToday->count() < config('song.reviews.no_of_songs_to_review')) {
             return redirect('/akaunti/review-nyimbo');
        }
                
        return $next($request);
    }
}
