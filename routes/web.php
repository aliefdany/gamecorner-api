<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ScheduleController;

Route::get('/schedule', [ScheduleController::class, 'indexJoined'])->name('schedule');
Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');
// Route::middleware(['auth', 'verified'])->group(function () {
// });

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/dashboard', [OrderController::class, 'indexJoined'])->name('dashboard');

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__ . '/auth.php';
