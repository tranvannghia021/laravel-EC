<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([

            ['id' => 1,'img' =>'444 Backpack - BLACK PLASTIC 2.png'],
            ['id' => 2,'img' =>'DALAT BACKPACK - PINKGRAY.png'],
            ['id' => 3,'img' =>'DALAT BACKPACK - BLUE COBAN.png'],
            ['id' => 4,'img' =>'BAMA BUMBAG Green.png'],
            ['id' => 5,'img' =>' Green.png'],

      
        ]);
    }
}
