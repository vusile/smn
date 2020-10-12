<?php

namespace App\Http\Middleware;

use App\Models\Song;
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
        if(auth()->user()->hasRole('super admin')) {
            return $next($request);
        }

        if(Song::pending()->count() > 0) {
            $reviewedToday = DB::table('reviews')
                ->where('user_id', auth()->user()->id)
                ->whereDate('created_at', Carbon::now()->toDateString())
                ->groupBy('song_id')
                ->get();

            $noSongsToReview = session('no_songs_to_review', false);
            if (
                $reviewedToday->count() < config('song.reviews.no_of_songs_to_review')
                && !$noSongsToReview
            ) {
                return redirect('/akaunti/review-nyimbo');
            }
        }

        return $next($request);
    }
}
