<?php

namespace Database\Factories;

use App\Models\JourneyCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JourneyCard>
 */
class JourneyCardFactory extends Factory
{
    protected $model = JourneyCard::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(6),
            'image_path' => 'images/assets/journey_1.png',
            'image_alt' => fake()->sentence(3),
            'order' => fake()->numberBetween(1, 5),
            'link_url' => null,
            'is_active' => true,
        ];
    }
}
