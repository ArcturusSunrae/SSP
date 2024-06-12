<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 10000, 1000000),
            'location' => $this->faker->address,
            'category_id' =>1
        ];
    }
}
