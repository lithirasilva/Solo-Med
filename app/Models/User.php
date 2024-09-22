<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, HasTeams, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'firstName',
        'lastName',
        'phone',
        'address',
        'dateOfBirth',
        'specialty',
        'medicalCouncilRegistration',
        'patientId',
        'bloodType',
        'weightKg',
        'heightCm',
        'emergencyContactName',
        'emergencyContactPhone',
        'specialNotes',
        'gender',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $extraAttributes = [
        'firstName' => '',
        'lastName' => '',
        'phone' => '',
        'address' => [],
        'dateOfBirth' => '',
        'specialty' => '',
        'medicalCouncilRegistration' => '',
        'patientId' => '',
        'bloodType' => '',
        'weightKg' => '',
        'heightCm' => '',
        'emergencyContactName' => '',
        'emergencyContactPhone' => '',
        'specialNotes' => '',
        'gender'=> '',


    ];

    public function setExtraAttributes(array $attributes)
    {
        $this->extraAttributes = $attributes;
    }

    public function getExtraAttributes(): array
    {
        return $this->extraAttributes;
    }

    public function clinicStaff(): HasOne
    {
        return $this->hasOne(ClinicStaff::class, 'user_id', 'id');
    }

    public function practitioner(): HasOne
    {
        return $this->hasOne(Practitioner::class, 'user_id', 'id');
    }

    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class, 'user_id', 'id');
    }
}
