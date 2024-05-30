<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // echo $schedule;
        $sched = DB::table('schedules')
        ->join('console_availables', 'schedules.console_available_id','console_availables.id')
        ->join('consoles', 'console_availables.console_id', 'consoles.id')
        ->orderBy('consoles.name', 'asc')
        ->where('schedules.id', $id)
        ->select('schedules.*', 'console_availables.code' ,'consoles.name')
        ->get();

        return view('schedule.detail', ['schedule' => $sched->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    /**
     * View joined schedules data
     */
    public function indexJoined(Request $request) {
        $date = '';
        if(!$request->query('date')) {
            $date = now();
        } else {
            $date = Carbon::createFromFormat('d/m/Y', $request->query('date'));
        }

        $schedulesByConsole = DB::table('schedules')
        ->join('console_availables', 'schedules.console_available_id','console_availables.id')
        ->join('consoles', 'console_availables.console_id', 'consoles.id')
        ->orderBy('consoles.name', 'asc')
        ->select('schedules.*', 'console_availables.code' ,'consoles.name')
        ->whereDate('date',$date->format('Y-m-d'))
        ->get();


        $bookingListsArray = json_decode(json_encode($schedulesByConsole), true);

        $grouped = array();
        foreach($bookingListsArray as $b) {

            $key = $b['console_available_id'];

            if (array_key_exists($key, $grouped)) {
                array_push($grouped[$key]['schedules'], $b);
            } else {
                $grouped[$key] = array('name'=> $b['name'], 'console_available_id'=> $key,'schedules' => array($b));
            }
        }

        $schedulesByConsole = json_decode(json_encode($grouped));

        return view('schedule.list', ['schedulesByConsole' => $schedulesByConsole]);
    }
}
