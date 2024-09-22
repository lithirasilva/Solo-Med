<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointmentId');
            $table->foreignId('patientId')->constrained('patients', 'patientId')->onDelete('cascade');
            $table->foreignId('doctorId')->constrained('practitioners', 'doctorId')->onDelete('cascade');
            $table->date('date');
            $table->time('startTime')->nullable();
            $table->time('endTime')->nullable();
            $table->string('status');
            $table->string('reason')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('medicalRecordsId')->nullable()->constrained('medical_records', 'medicalRecordId')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

