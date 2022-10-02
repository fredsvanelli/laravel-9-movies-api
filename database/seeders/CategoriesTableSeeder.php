<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('categories')->insert([
            [
                'name' => 'Action',
                'slug' => 'action',
            ],
            [
                'name' => 'Adventure',
                'slug' => 'adventure',
            ],
            [
                'name' => 'Comedy',
                'slug' => 'comedy',
            ],
            [
                'name' => 'Drama',
                'slug' => 'drama',
            ],
            [
                'name' => 'Fantasy',
                'slug' => 'fantasy',
            ],
            [
                'name' => 'Horror',
                'slug' => 'horror',
            ],
        ]);
    }
}
