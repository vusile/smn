<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanDelete
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(
            auth()->user()->id == $request->user_id
            || auth()->user()->id == $request->route('song')->composer->user_id
            || auth()->user()->hasAnyRole(['super admin', 'admin'])
        ) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', "Huwezi kufuta wimbo huu. Walisiana na Admin");
        }
    }
}
