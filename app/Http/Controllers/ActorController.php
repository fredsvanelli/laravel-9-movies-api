<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorRequest;
use App\Http\Resources\ActorResource;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ActorController extends Controller
{
    public function index(Request $request)
    {
        $query = Actor::query();

        if ($request->search){
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->has('with_movies')){
            $query->with(['movies.categories']);
        }

        $actors = $query->orderBy(
            $request->input('order_by', 'id'),
            $request->input('order', 'desc')
        )->paginate($request->input('per_page', 36));

        return ActorResource::collection($actors);
    }

    public function store(ActorRequest $request)
    {
        $data = $request->validated();

        $actor = Actor::create(array_merge(
            $data,
            ['slug' => Str::slug($request->name)]
        ));

        if ($request->filled('movies')){
            $i = 0;
            $movies = [];
            foreach ($request->movies as $movie){
                $movies[$movie] = ['order' => $i++];
            }

            $actor->movies()->attach($movies);
        }

        $actor->load(['movies']);

        return (new ActorResource($actor))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Actor $actor)
    {
        $actor->load(['movies']);

        return new ActorResource($actor);
    }

    public function update(ActorRequest $request, Actor $actor)
    {
        $data = $request->validated();

        $actor->fill(array_merge(
            $data,
            ['slug' => Str::slug($request->name)]
        ))->save();

        if ($request->filled('movies')){
            $i = 0;
            $movies = [];
            foreach ($request->movies as $movie){
                $movies[$movie] = ['order' => $i++];
            }

            $actor->movies()->sync($movies);
        }

        $actor->load(['movies']);

        return new ActorResource($actor);
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
