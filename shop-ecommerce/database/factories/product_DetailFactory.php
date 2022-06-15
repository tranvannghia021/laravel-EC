<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product_detail;
class product_DetailFactory extends Factory
{
   
     protected $model =Product_detail::class;
     
    public function definition()
    {
        return [
           'product_id'=>$this->faker->numberBetween(0,20),
           'code_color' => $this->faker->hexcolor,
           'amount' => $this->faker->numberBetween(0,20),
           'price'=>'100',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),

        ];
    }
}
