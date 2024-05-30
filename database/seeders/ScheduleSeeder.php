<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\ConsoleAvailable;

use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $times = [
            ["start" => '9:30', "end" => '10:30'],
            ["start" => '10:30', "end" => '11:30'],
            ["start" => '11:30', "end" => '12:30'],
            ["start" => '12:30', "end" => '13:30'],
            ["start" => '13:30', "end" => '14:30'],
            ["start" => '14:30', "end" => '15:30'],
            ["start" => '15:30', "end" => '16:30'],
            ["start" => '16:30', "end" => '17:30']
        ];

        $dates = $this->datesFromCurrentTo14DaysAhead();

        $consoleIds = ConsoleAvailable::all()->pluck('id')->toArray();

        foreach ($consoleIds as $consoleId) {
            foreach($dates as $date) {
                foreach ($times as $time) {
                    Schedule::factory()->create([
                        'console_available_id' => $consoleId,
                        'date' => $date,
                        'start'=> $time["start"],
                        'end'=> $time["end"]
                    ]);
                }
            }
        }
    }

    function datesFromCurrentTo14DaysAhead() {
        $currentDay = date('j');
        $currentMonth = date('n');
        $currentYear = date('Y');
        
        $datesArray = array();
        
        for ($i = 0; $i < 14; $i++) {
            $day = $currentDay + $i;
            $dateString = date('Y-m-d', mktime(0, 0, 0, $currentMonth, $day, $currentYear));
            $datesArray[] = $dateString;
        }
        
        return $datesArray;
    }
}
