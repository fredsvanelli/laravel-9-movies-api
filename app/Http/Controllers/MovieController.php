<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::paginate(36));
    }

    public function store(MovieRequest $request)
    {
        $data = $request->validated();

        $movie = Movie::create(array_merge(
            $data,
            ['slug' => Str::slug($request->title)]
        ));

        return (new MovieResource($movie))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    public function update(MovieRequest $request, Movie $movie)
    {
        $data = $request->validated();

        $movie->fill(array_merge(
            $data,
            ['slug' => Str::slug($request->title)]
        ))->save();

        return new MovieResource($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
