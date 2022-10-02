<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query()->with('categories');

        if ($request->has('with_actors')){
            $query->with('actors');
        }

        if ($request->category){
            $query->whereHas('categories', function($q) use ($request){
                $q->where('categories.slug', $request->category);
            });
        }

        if ($request->search){
            $query->where('title', 'like', "%{$request->search}%");
        }

        $movies = $query->orderBy(
            $request->input('order_by', 'id'),
            $request->input('order', 'desc')
        )->paginate($request->input('per_page', 36));

        return MovieResource::collection($movies);
    }

    public function store(MovieRequest $request)
    {
        $data = $request->validated();

        $movie = Movie::create(array_merge(
            $data,
            ['slug' => Str::slug($request->title)]
        ));

        if ($request->filled('categories')){
            $movie->categories()->attach($request->categories);
        }

        if ($request->filled('actors')){
            $i = 0;
            $actors = [];
            foreach ($request->actors as $actor){
                $actors[$actor] = ['order' => $i++];
            }

            $movie->actors()->attach($actors);
        }

        $movie->load(['categories', 'actors']);

        return (new MovieResource($movie))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Movie $movie)
    {
        $movie->load(['categories', 'actors']);

        return new MovieResource($movie);
    }

    public function update(MovieRequest $request, Movie $movie)
    {
        $data = $request->validated();

        $movie->fill(array_merge(
            $data,
            ['slug' => Str::slug($request->title)]
        ))->save();

        $movie->categories()->sync($request->categories ?? []);

        if ($request->filled('actors')){
            $i = 0;
            $actors = [];
            foreach ($request->actors as $actor){
                $actors[$actor] = ['order' => $i++];
            }

            $movie->actors()->sync($actors);
        }

        $movie->load(['categories', 'actors']);

        return new MovieResource($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
