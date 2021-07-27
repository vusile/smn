<?php

namespace App\Http\Middleware;

use App\Models\Song;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CheckSongStatus
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->path();
        $id = Arr::last(
                explode("/", $uri)
            );

        $song = Song::find($id);

        if ($song->is_pending || $song->is_denied || $song->is_deleted) {
            return redirect(route('missing-page'));
        } else {
            return $next($request);
        }
    }
}
