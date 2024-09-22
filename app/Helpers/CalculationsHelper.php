<?php

namespace App\Helpers;

use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class CalculationsHelper
{
    public static function calculateAge($birthdate)
    {
        $birthdate = Carbon::parse($birthdate);
        return $birthdate->age;
    }

    public static function calculateLastVisit($patientId)
    {
        // Retrieve the latest appointment for the given patientId
        $lastAppointment = Appointments::where('patient_id', $patientId) // Ensure the column name is correct
        ->orderBy('date', 'desc')
            ->orderBy('time', 'desc') // Ensure the time is also considered if multiple appointments are on the same date
            ->first();

        // Check if an appointment exists
        if ($lastAppointment) {
            // Return the last appointment date as a Carbon instance
            return $lastAppointment->date ;
        } else {
            // If no appointment is found, return null or handle accordingly
            return null;
        }
    }

    public static function addToResponse($collection, $key, $value)
    {
        return $collection->map(function ($item) use ($key, $value) {
            $item->$key = $value;
            return $item;
        });
    }

    public static function addFullNameToPerson($person)
    {
        $fullName = $person->firstName . ' ' . $person->lastName;
        return self::addToResponse(collect([$person]), 'name', $fullName)->first();
    }

    public static function addFullNameToCollection($collection)
    {
        return $collection->map(function ($item) {
            $fullName = $item->firstName . ' ' . $item->lastName;
            return self::addToResponse(collect([$item]), 'name', $fullName)->first();
        });
    }

    public static function addLastVisitToCollection($collection)
    {
        return $collection->map(function ($item) {
            $lastVisit = self::calculateLastVisit($item->patientId);
            return self::addToResponse(collect([$item]), 'lastVisit', $lastVisit)->first();
        });
    }

    public static function addAgeToCollection($collection)
    {
        return $collection->map(function ($item) {
            $age = self::calculateAge($item->dateOfBirth);
            return self::addToResponse(collect([$item]), 'age', $age)->first();
        });
    }


    public static function addAgeAndLastVisitToPatient($patient)
    {
        $patient->age = self::calculateAge($patient->dateOfBirth);
        $patient->lastVisit = self::calculateLastVisit($patient->patientId);
        return $patient;
    }

}
