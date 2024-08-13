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
            'property_name' => $this->faker->unique()->sentence(),
            'address' => $this->faker->address(),
            'bedrooms' => $this->faker->numberBetween(1, 10),
            'bathrooms' => $this->faker->numberBetween(1, 10),
            'floor' => $this->faker->numberBetween(1, 50),
            'is_parking_available' => $this->faker->boolean(),
            'parking_spots' => $this->faker->numberBetween(0, 5),
            'description' => $this->faker->text(),
            'area' => $this->faker->randomFloat(2, 50, 200), // Example: between 50 and 200 sq meters
            'price' => $this->faker->randomFloat(2, 100000, 1000000), // Example: between 100,000 and 1,000,000 currency units
            'payment_process' => $this->faker->realText(),
            'safety' => $this->faker->realText(),
            'category_id' => 1,
            'image_url' => $this->faker->imageUrl()
        ];
    }
}
