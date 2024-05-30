<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ConsoleAvailable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date" => fake()->date("now"),
            "start" => fake()->time(),
            "end" => fake()->time(),
            "status" => "AVAILABLE",
            'console_available_id' => ConsoleAvailable::factory(),
        ];
    }
}
