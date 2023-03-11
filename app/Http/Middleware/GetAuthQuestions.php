<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GetAuthQuestions
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
        if(
            !auth()->user()->authAnswers()->count()
        ) {
            return redirect('/password-reset-questions');
        }
        else {
            return $next($request);
        }
    }
}
