<?php

namespace App\Policies;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicalRecordPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role === 'doctor' || $user->role === 'admin';
    }

    public function view(User $user, MedicalRecord $medicalRecord)
    {
        return $user->id === $medicalRecord->doctorId || $user->id === $medicalRecord->patient->user_id;
    }

    public function create(User $user)
    {
        return $user->role === 'doctor';
    }

    public function update(User $user, MedicalRecord $medicalRecord)
    {
        return $user->id === $medicalRecord->doctorId;
    }

    public function delete(User $user, MedicalRecord $medicalRecord)
    {
        return $user->role === 'admin';
    }
}
