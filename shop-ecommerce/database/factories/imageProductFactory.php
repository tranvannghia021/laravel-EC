<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image_product;
class imageProductFactory extends Factory
{
   
     protected $model =Image_product::class;
     
    public function definition()
    {
        return [
           'product_id'=>$this->faker->numberBetween(0,20),
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),

        ];
    }
}
