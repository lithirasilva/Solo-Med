<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Practitioner extends Model
{
    use HasFactory;

    protected $primaryKey = 'doctorId'; // Specify the primary key if it's not `id`

    protected $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'phone',
        'address',
        'dateOfBirth',
        'specialty',
        'medicalCouncilRegistration'
    ];

    /**
     * Get the user that owns the practitioner.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
