<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->city,
            'slug' => fake()->unique()->slug(2),
            'parent_id' => null,
        ];
    }
}
