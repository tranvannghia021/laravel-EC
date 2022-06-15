<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupProductFactory extends Factory
{

    protected $model =GroupProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name'=>$this->faker->randomElement(["Ba Lô","Túi Nhỏ","Ba Lô Mang Vai","Ví"]),        
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),

        ];
    }
}


