<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+1 month');
        $endDate = (clone $startDate)->modify('+1 day');

        return [
            'title' => fake()->sentence(5),
            'description' => fake()->paragraphs(2, true),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => fake()->city(),
            'time_text' => '08:00 WIB',
            'created_by' => User::factory(),
        ];
    }
}