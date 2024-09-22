<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id('medicalRecordId');
            $table->foreignId('appointmentId')->nullable()->constrained('appointments', 'appointmentId')->onDelete('set null');
            $table->foreignId('patientId')->constrained('patients', 'patientId')->onDelete('cascade');
            $table->foreignId('doctorId')->constrained('practitioners', 'doctorId')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->text('prescription')->nullable();
            $table->string('recordType');
            $table->string('recordTitle');
            $table->string('uploads')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
