<?php

namespace Database\Seeders;

use App\Models\Appointments;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Models\MedicalRecord;
use Carbon\Carbon;

class AppointmentsSeeder extends Seeder
{
    public function run()
    {
        $patients = Patient::all();
        $doctors = User::where('role', 'doctor')->get();

        foreach ($patients as $patient) {
            $doctor = $doctors->random();

            // Create a medical record
            $medicalRecord = MedicalRecord::create([
                'patientId' => $patient->patientId,
                'doctorId' => $doctor->id,
                'diagnosis' => 'Sample diagnosis',
                'treatment' => 'Sample treatment',
                'prescriptions' => 'Sample prescriptions',
                'notes' => 'Sample notes',
            ]);

            // Generate a random date and time for the appointment
            $date = Carbon::now()->addDays(rand(1, 30))->format('Y-m-d');
            $startTime = Carbon::createFromFormat('H:i', sprintf('%02d:00', rand(9, 16)))->format('H:i');
            $endTime = Carbon::createFromFormat('H:i', $startTime)->addHours(1)->format('H:i');

            // Create the appointment
            Appointments::create([
                'patientId' => $patient->patientId,
                'doctorId' => $doctor->id,
                'date' => $date,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'status' => 'scheduled',
                'reason' => 'Regular check-up',
                'notes' => 'Patient requested this appointment for a routine check-up.',
                'medicalRecordsId' => $medicalRecord->id,
            ]);
        }
    }
}
