<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Console;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsoleAvailable>
 */
class ConsoleAvailableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'console_id' => Console::factory(),
            'code' => fake()->unique()->lexify('console-????'),
            'status' => 'AVAILABLE',
        ];
    }
}
