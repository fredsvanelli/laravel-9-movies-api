<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('actors')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Actor::create([
            'name' => 'Dwayne Johnson',
            'slug' => 'dwayne-johnson',
            'picture' => 'https://m.media-amazon.com/images/M/MV5BMTkyNDQ3NzAxM15BMl5BanBnXkFtZTgwODIwMTQ0NTE@._V1_.jpg',
            'biography' => 'Dwayne Douglas Johnson, also known as The Rock, was born on May 2, 1972 in Hayward, California. He is the son of Ata Johnson (born Feagaimaleata Fitisemanu Maivia) and professional wrestler Rocky Johnson (born Wayde Douglas Bowles). His father, from Amherst, Nova Scotia, Canada, is black (of Black Nova Scotian descent), and his mother is of Samoan background (her own father was Peter Fanene Maivia, also a professional wrestler). While growing up, Dwayne traveled around a lot with his parents and watched his father perform in the ring. During his high school years, Dwayne began playing football and he soon received a full scholarship from the University of Miami, where he had tremendous success as a football player. In 1995, Dwayne suffered a back injury which cost him a place in the NFL. He then signed a three-year deal with the Canadian League but left after a year to pursue a career in wrestling.',
            'birth_date' => '1972-05-02',
            'birth_place' => 'Hayward, California, USA',
        ]);

        Actor::create([
            'name' => 'Pierce Brosnan',
            'slug' => 'pierce-brosnan',
            'picture' => 'https://m.media-amazon.com/images/M/MV5BMTMwMjMxNzM4OV5BMl5BanBnXkFtZTcwNDM5NzkxMw@@._V1_.jpg',
            'biography' => 'Pierce Brendan Brosnan was born in Drogheda, County Louth, Ireland, to May (Smith), a nurse, and Thomas Brosnan, a carpenter. He lived in Navan, County Meath, until he moved to England, UK, at an early age (thus explaining his ability to play men from both backgrounds convincingly). His father left the household when Pierce was a child and although reunited later in life, the two have never had a close relationship. His most popular role is that of British secret agent James Bond. The death, in 1991, of Cassandra Harris, his wife of eleven years, left him with three children - Christopher and Charlotte from Cassandra\'s first marriage and Sean from their marriage. Since her death, he has had two children with his second wife, Keely Shaye Brosnan.',
            'birth_date' => '1953-05-16',
            'birth_place' => 'Drogheda, County Louth, Ireland',
        ]);

        Actor::create([
            'name' => 'Elijah Wood',
            'slug' => 'elijah-wood',
            'picture' => 'https://m.media-amazon.com/images/M/MV5BMTM0NDIxMzQ5OF5BMl5BanBnXkFtZTcwNzAyNTA4Nw@@._V1_.jpg',
            'biography' => 'Elijah Wood is an American actor best known for portraying Frodo Baggins in Peter Jackson\'s blockbuster Lord of the Rings film trilogy. In addition to reprising the role in The Hobbit series, Wood also played Ryan in the FX television comedy Wilfred (2011) and voiced Beck in the Disney XD animated television series Tron: A Resistência (2012).',
            'birth_date' => '1981-01-28',
            'birth_place' => 'Cedar Rapids, Iowa, USA',
        ]);

        Actor::create([
            'name' => 'Ian McKellen',
            'slug' => 'ian-mcKellen',
            'picture' => 'https://m.media-amazon.com/images/M/MV5BMTQ2MjgyNjk3MV5BMl5BanBnXkFtZTcwNTA3NTY5Mg@@._V1_.jpg',
            'biography' => 'Widely regarded as one of greatest stage and screen actors both in his native Great Britain and internationally, twice nominated for the Oscar and recipient of every major theatrical award in the UK and US, Ian Murray McKellen was born on May 25, 1939 in Burnley, Lancashire, England, to Margery Lois (Sutcliffe) and Denis Murray McKellen, a civil engineer and lay preacher. He is of Scottish, Northern Irish, and English descent. During his early childhood, his parents moved with Ian and his older sister, Jean, to the mill town of Wigan. It was in this small town that young Ian rode out World War II. He soon developed a fascination with acting and the theatre, which was encouraged by his parents. They would take him to plays, those by William Shakespeare, in particular. The amateur school productions fostered Ian\'s growing passion for theatre.',
            'birth_date' => '1939-05-25',
            'birth_place' => 'Burnley, Lancashire, England, UK',
        ]);
    }
}
