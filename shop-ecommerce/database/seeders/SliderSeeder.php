<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            ['id' => 1,'name'=>'Hè Thu 2022','description'=>'Đón Chào Ngày Mới ','thumb'=>'166016018_3334348926667077_3223220780734921821_n.jpg','active'=>1,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 2,'name'=>'Thu Sang','description'=>'Có Ai Chờ ','thumb'=>'271832791_4184032725032022_2966059218423594134_n.jpg','active'=>1,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 3,'name'=>'Phố Thị Thu Sang','description'=>'2022 ','thumb'=>'slideshow_2.jpg','active'=>0,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            
        ]);
    }
}
