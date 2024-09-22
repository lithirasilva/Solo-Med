<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'patientId';

    protected $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'email',
        'phone',
        'address',
        'dateOfBirth',
        'bloodType',
        'weightKg',
        'heightCm',
        'emergencyContactName',
        'emergencyContactPhone',
        'specialNotes',
        'gender',
    ];

    protected $casts = [
        'address' => 'array',
        'dateOfBirth' => 'date',
        'weightKg' => 'decimal:2',
        'heightCm' => 'decimal:2',
    ];

    /**
     * Get the user that owns the patient.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointments::class);
    }

}
