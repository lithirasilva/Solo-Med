<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patientId');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('phone');
            $table->json('address');
            $table->date('dateOfBirth');
            $table->string('bloodType');
            $table->decimal('weightKg', 5, 2);
            $table->decimal('heightCm', 5, 2);
            $table->string('emergencyContactName');
            $table->string('emergencyContactPhone');
            $table->text('specialNotes')->nullable();
            $table->text('gender');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
