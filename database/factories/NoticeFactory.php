<?php

namespace Database\Factories;

use App\Enums\NoticeBadge;
use App\Enums\NoticeType;
use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notice>
 */
class NoticeFactory extends Factory
{
    protected $model = Notice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'date_text' => fake()->date('d M Y').' - 10:00 AM',
            'badge' => fake()->randomElement(NoticeBadge::cases()),
            'type' => fake()->randomElement(NoticeType::cases()),
            'icon_path' => null,
            'link_url' => null,
            'order' => fake()->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
