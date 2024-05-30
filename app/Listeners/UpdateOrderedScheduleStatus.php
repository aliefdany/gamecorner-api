<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Schedule;

class UpdateOrderedScheduleStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $schedule = Schedule::find($event->order->schedule_id);

        $schedule->status = "ORDERED";

        $schedule->save();
    }
}
