<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;
use App\Models\Appointment;

class MedicalRecordSeeder extends Seeder
{
    public function run()
    {
        Appointment::all()->each(function ($appointment) {
            MedicalRecord::create([
                'appointmentId' => $appointment->appointmentId,
                'patientId' => $appointment->patientId,
                'doctorId' => $appointment->doctorId,
                'notes' => json_encode([
                    [
                        'title' => 'Initial Assessment',
                        'type' => 'observation',
                        'note' => 'Patient presents with...'
                    ],
                    [
                        'title' => 'Treatment Plan',
                        'type' => 'plan',
                        'note' => 'Recommended course of action...'
                    ]
                ]),
                'prescription' => 'Prescription details...',
                'recordType' => 'General Consultation',
                'recordTitle' => 'Routine Check-up',
                'uploads' => json_encode([
                    [
                        'name' => 'X-Ray Results',
                        'path' => '/uploads/xray.pdf'
                    ]
                ]),
            ]);
        });
    }
}
