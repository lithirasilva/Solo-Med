<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinic_staff', function (Blueprint $table) {
            $table->id('staffId'); // Creates an auto-incrementing primary key column

            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Automatically references 'id' on 'users'
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone', 20);
            $table->json('address');
            $table->date('dateOfBirth');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinic_staff');
    }
};
