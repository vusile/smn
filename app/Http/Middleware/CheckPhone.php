<?php

namespace App\Http\Middleware;

use Closure;

class CheckPhone
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
        if(
            !auth()->user()->phone_verified       
        ) {
            return redirect('/phone-collector');
        }
        else {
            return $next($request);
        }
    }
}
