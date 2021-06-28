<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MovieRequest;
use App\Http\Resources\Api\v1\MovieCollection;
use App\Http\Resources\Api\v1\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);
        return response(new MovieCollection($movies), Response::HTTP_OK);
    }

    public function store(MovieRequest $request)
    {
        $movie = $this->save($request);

        return response(new MovieResource($movie), Response::HTTP_CREATED);
    }

    public function show(Request $request)
    {
        $movie = $request->movie;

        return response(new MovieResource($movie), Response::HTTP_OK);
    }

    public function update(MovieRequest $request)
    {
        $movie = $this->save($request);

        return response(new MovieResource($movie), Response::HTTP_OK);
    }

    public function destroy(Request $request)
    {
        $movie = $request->movie;
        $movie->delete();

        return response('', Response::HTTP_OK);
    }

    private function save(Request $request)
    {
        $movie = Movie::firstOrNew(['id' => $request->movieId ?? null]);
        $movie->title = $request->title ?? $movie->title;
        $movie->year = $request->year ?? $movie->year;
        $movie->released_date = $request->released_date ?? $movie->released_date;
        $movie->save();

        return $movie;
    }
}
