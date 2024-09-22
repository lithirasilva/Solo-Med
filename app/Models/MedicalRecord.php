<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MedicalRecord extends Model
{

    protected $primaryKey = 'medicalRecordId';
    protected $fillable = [
        'patientId',
        'doctorId',
        'appointmentId',
        'recordTitle',
        'recordType',
        'notes',
        'prescription',
        'uploads',
    ];

protected $casts = [
        'recordType' => 'array',
    ];

//relationships
    // Relationship to the Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientId', 'patientId');
    }

    // Relationship to the Practitioner model (doctor)
    public function doctor()
    {
        return $this->belongsTo(Practitioner::class, 'doctorId', 'doctorId');
    }

    // Optional relationship to the Appointment model
    public function appointment()
    {
        return $this->belongsTo(Appointments::class, 'appointmentId', 'appointmentId');
    }


    use HasFactory;
}

