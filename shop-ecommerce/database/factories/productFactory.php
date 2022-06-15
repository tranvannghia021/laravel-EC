<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
class productFactory extends Factory
{
   
     protected $model =Product::class;
     
    public function definition()
    {
        return [
           'group_id'=>$this->faker->randomElement([1,2,3]),
           'name' => $this->faker->firstName,
           'description' => $this->faker->firstName,
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),

        ];
    }
}
