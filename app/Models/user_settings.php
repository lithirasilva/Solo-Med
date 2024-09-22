<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $primaryKey = 'settings_id';

    protected $fillable = [
        'clinic_id',
        'clinicOpenDays',
        'clinicHours',
        'clinicClosed',
        'appointmentDuration',
        'appointmentInterval',
        'bookablePeriod',
        'appointmentLimit',

    ];

    protected $casts = [
        'clinicOpenDays' => 'json',
        'clinicHours' => 'json',
        'clinicClosed' => 'json',
    ];

//    public function clinic()
//    {
//        return $this->belongsTo(Clinic::class, 'clinic_id', 'clinic_id');
//    }
}
