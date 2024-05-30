<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ConsoleAvailable;
use App\Models\Console;

use Database\Seeders\ConsoleSeeder;

class ConsoleAvailableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ConsoleSeeder::class
        ]);

        $consoles = Console::all()->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            ConsoleAvailable::factory()->create([
                'console_id' => fake()->randomElements($consoles)[0]
            ]);
        }

    }
}
