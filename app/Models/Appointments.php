<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointmentId';

    protected $fillable = [
        'patientId',
        'doctorId',
        'date',
        'startTime',
        'endTime',
        'status',
        'reason',
        'notes',
        'medicalRecordsId',
    ];

    protected $casts = [
        'date' => 'date',
        'startTime' => 'datetime',
        'endTime' => 'datetime',
    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patientId');
    }

    public function doctor()
    {
        return $this->belongsTo(Practitioner::class, 'doctorId');
    }

    public function medicalRecord()
    {
        return $this->hasMany(MedicalRecord::class, 'medicalRecordId');
    }
}
