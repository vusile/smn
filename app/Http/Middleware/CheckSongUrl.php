<?php

namespace App\Http\Middleware;

use App\Models\Song;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CheckSongUrl
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
        $uri = $request->path();
        $id = Arr::last(
                explode("/", $uri)
            );

        $cacheName = "song.{$id}";

        $song = Cache::rememberForever($cacheName, function () use ($id) {
            return Song::find($id);
        });

        $correctSongUri = '/wimbo/' . $song->url . '/' . $song->id;

        if(str_contains($correctSongUri, $uri)) {
            return $next($request);
        }
        else {
            return redirect($correctSongUri, 301);
        }
    }
}
