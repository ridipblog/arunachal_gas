<?php

namespace Database\Factories;

use App\Models\Milestone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Milestone>
 */
class MilestoneFactory extends Factory
{
    protected $model = Milestone::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'period' => fake()->monthName().' '.fake()->year(),
            'title' => fake()->sentence(8),
            'icon' => fake()->randomElement(['document', 'gavel', 'handshake', 'verified', 'users', 'megaphone', 'map-pin', 'settings']),
            'custom_icon_path' => null,
            'is_highlighted' => false,
            'order' => fake()->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
