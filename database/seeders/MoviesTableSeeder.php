<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('movies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // Create the movies
        $movies = [];

        $movies[] = Movie::create(
            [
                'slug' => 'black-adam',
                'title' => 'Black Adam',
                'description' => 'Nearly 5,000 years after he was bestowed with the almighty powers of the Egyptian gods-and imprisoned just as quickly-Black Adam (Johnson) is freed from his earthly tomb, ready to unleash his unique form of justice on the modern world.',
                'director' => 'Jaume Collet-Serra',
                'year' => 2022,
                'duration' => 124,
                'score' => 9.9,
                'cover' => 'https://m.media-amazon.com/images/M/MV5BYzZkOGUwMzMtMTgyNS00YjFlLTg5NzYtZTE3Y2E5YTA5NWIyXkEyXkFqcGdeQXVyMjkwOTAyMDU@._V1_.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=X0tOpBuYasI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        $movies[] = Movie::create(
            [
                'slug' => 'the-lord-of-the-rings-the-fellowship-of-the-ring',
                'title' => 'The Lord of the Rings: The Fellowship of the Ring',
                'description' => 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.',
                'director' => 'Peter Jackson',
                'year' => 2001,
                'duration' => 178,
                'score' => 8.8,
                'cover' => 'https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=V75dMMIW2B4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Relate to the categories
        $action = DB::table('categories')->where('name', 'Action')->first();
        $adventure = DB::table('categories')->where('name', 'Adventure')->first();
        $fantasy = DB::table('categories')->where('name', 'Fantasy')->first();

        $movies[0]->categories()->sync([$action->id, $fantasy->id]);
        $movies[1]->categories()->sync([$adventure->id, $fantasy->id]);

        // Relate to the actors
        $actors = Actor::whereIn(
            'name',
            [
                'Dwayne Johnson',
                'Elijah Wood',
                'Ian McKellen',
                'Pierce Brosnan',
            ]
        )
            ->orderBy('name', 'asc')
            ->get();

        $movies[0]->actors()->sync([
            $actors[0]->id => ['order' => 0],
            $actors[3]->id => ['order' => 1],
        ]);

        $movies[1]->actors()->sync([
            $actors[1]->id => ['order' => 0],
            $actors[2]->id => ['order' => 1],
        ]);
    }
}
