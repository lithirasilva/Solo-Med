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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctorId')->constrained()->onDelete('cascade');
            $table->date('date'); //Create logic to make the clinic open by default in the given clinic hours, unless this table specifies open hours on a date or has closed on that day.
            $table->time('openTime')->default('08:00:00');
            $table->time('closeTime')->default('17:00:00');
            $table->boolean('onLeave')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
