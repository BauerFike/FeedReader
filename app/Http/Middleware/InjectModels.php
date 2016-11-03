<?php

namespace App\Http\Middleware;

use Closure;
use View;
use App\Feed;
use App\Category;

class InjectModels
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
        View::share('feeds', Feed::all());
        View::share('categories', Category::all());
        return $next($request);
    }
}
