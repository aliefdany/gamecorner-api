<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('console_available_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['AVAILABLE', 'ORDERED']);
            $table->unsignedSmallInteger('controller_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
