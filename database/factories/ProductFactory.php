<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraphs(asText: true),
            'price' => $this->faker->numberBetween(int1: 300, int2: 30000),
            'category_id' => $this->faker->numberBetween(int1: 0, int2: 5),
        ];
    }
}
