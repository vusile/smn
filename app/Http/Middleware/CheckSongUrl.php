<?php

namespace App\Http\Middleware;

use App\Song;
use Closure;

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
        $id = array_last(
                explode("/", $uri)
            );
        
        $song = Song::find($id);
       
        $correctSongUri = '/wimbo/' . $song->url . '/' . $song->id;
       
        if(str_contains($correctSongUri, $uri)) {
            return $next($request);
        }
        else {
            return redirect($correctSongUri, 301);
        }
    }
}
