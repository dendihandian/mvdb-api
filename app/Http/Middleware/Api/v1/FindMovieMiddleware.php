<?php

namespace App\Http\Middleware\Api\v1;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Movie;
use Closure;
use Illuminate\Http\Request;

class FindMovieMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $movieId = $request->movieId ?? null;

        if (!$movie = Movie::where(['id' => $movieId])->first()) {
            throw new ResourceNotFoundException();
        }

        $request->merge([
            'movie' => $movie,
        ]);

        return $next($request);
    }
}
