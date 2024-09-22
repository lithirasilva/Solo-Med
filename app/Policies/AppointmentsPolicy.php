<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->patientId || $user->id === $appointment->doctorId;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->doctorId;
    }

    public function delete(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->doctorId;
    }
}
