<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdcutsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ProductName' => $this->faker->words(2, true),
            'Category' => $this->faker->randomElement(['Electronics', 'Clothing', 'Food']),
            'Stock' => $this->faker->numberBetween(1, 100),
            'Price' => $this->faker->numberBetween(1000, 1000000),
        ];
    }
}
