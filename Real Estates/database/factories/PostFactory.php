<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $propertyId = Property::inRandomOrder()->first()->id;

        return [
            'property_id' => $propertyId,
            'is_active' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTime()
        ];
    }
}
