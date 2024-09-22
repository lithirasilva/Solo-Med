<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicStaff extends Model
{
    use HasFactory;

    protected $primaryKey = 'staffId'; // Specify the primary key if it's not `id`

    protected $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'phone',
        'address',
        'dateOfBirth'
    ];

    /**
     * Get the user that owns the staff.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
