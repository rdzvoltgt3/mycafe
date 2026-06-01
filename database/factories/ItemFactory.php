<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'category_id' => $this->faker->numberBetween(1, 2),
            'price' => $this->faker->randomFloat(2, 1000, 100000),
            'description' => $this->faker->text(),
            'image' => fake()->randomElement(
                ['https://images.unsplash.com/photo-1612929633738-8fe44f7ec841',
                 'https://images.unsplash.com/photo-1578160112054-954a67602b88',
                 'https://images.unsplash.com/photo-1586765501019-cbe3973ef8fa']),
            'is_active' => $this ->faker->boolean(),
        ];
    }
}
