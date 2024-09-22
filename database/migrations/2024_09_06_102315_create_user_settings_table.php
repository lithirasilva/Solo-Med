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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id('settings_id');
            $table->foreignId('clinic_id')->references('clinic_id')->on('clinics');
            //table column to indicate which days of the week are open from the days of the week
            $table->json('clinicOpenDays');
            //table column to indicate the hours the clinic is open
            $table->json('clinicHours');
            //table column to indicate the days the clinic is closed
            $table->json('clinicClosed');
            //table column to indicate the duration of an appointment
            $table->integer('appointmentDuration');
            //table column to indicate the interval between appointments
            $table->integer('appointmentInterval');
            //table column to indicate the period of days from now between which appointments can be booked
            $table->integer('bookablePeriod');
            //table column to indicate the maximum number of appointments that can be booked in a day
            $table->integer('appointmentLimit');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('practitioner_id')->references('practitioner_id')->on('practitioners');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
