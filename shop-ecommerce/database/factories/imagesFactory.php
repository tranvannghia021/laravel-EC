<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\images;
class imagesFactory extends Factory
{
   
     protected $model =images::class;
     
    public function definition()
    {
        return [
           'id'=>$this->faker->numberBetween(0,20),
           'img' => $this->faker->text,           
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),

        ];
    }
}
