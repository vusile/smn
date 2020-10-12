<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use Illuminate\Support\Arr;

class CheckCategoryUrl
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

        $category = Category::find($id);

        $correctCategoryUri = '/makundi-nyimbo/' . $category->url . '/' . $category->id;

        if(str_contains($correctCategoryUri, $uri)) {
            return $next($request);
        }
        else {
            return redirect($correctCategoryUri, 301);
        }
    }
}
