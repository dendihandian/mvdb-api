<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    public function index()
    {
        return response(Movie::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $movie = $this->save($request);

        return response($movie, Response::HTTP_CREATED);
    }

    public function show(Request $request)
    {
        $movie = $request->movie;
        return response($movie, Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        $movie = $this->save($request);
        return response($movie, Response::HTTP_OK);
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
