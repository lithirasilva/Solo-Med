<?php

namespace App\Helpers;

use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Practitioner;
use App\Models\MedicalRecord;




class QueryProvider
{
    public static function nextAppointment()
    {
        //get current users doctorId
        $doctorId = auth()->user()->practitioner()->doctorId;

        // Retrieve the next appointment for the given doctorId
        $nextAppointment = Appointments::where('doctorId', $doctorId)
        ->where('date', '>=', Carbon::now())
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->first();

        return $nextAppointment;

    }

    //enter month and year and get the number of appointments for that month
    public static function getAppointmentsForMonth($month, $year)
    {
        //get current users doctorId
        $doctorId = auth()->user()->practitioner()->doctorId;

        // Retrieve the appointments for the given doctorId
        $appointments = Appointments::where('doctorId', $doctorId)
        ->whereMonth('date', $month)
        ->whereYear('date', $year)
        ->get();

        return $appointments->count();
    }

    //enter year and get the number of appointments for that year

    public static function getAppointmentsForYear($year)
    {
        //get current users doctorId
        $doctorId = auth()->user()->practitioner()->doctorId;

        // Retrieve the appointments for the given doctorId
        $appointments = Appointments::where('doctorId', $doctorId)
        ->whereYear('date', $year)
        ->get();

        return $appointments->count();
    }

    //Take patient and retrive the collection of appointments with that patientId
    public static function getAppointmentsForPatient($patientId)
    {
        // Retrieve the appointments for the given patientId
        $appointments = Appointments::where('patientId', $patientId)
        ->get();

        return $appointments;
    }

    public static function getDoctorId($id)
    {
        $doctorId = Practitioner::where('user_id', $id)->first()->doctorId;
        return $doctorId;
    }



    //Take doctor and retrive the collection of future appointments with that doctorId
    public static function upcomingAppointmentsForDoctor($doctorId)
    {
        // Retrieve the appointments for the given doctorId
        $appointments = Appointments::where('doctorId', $doctorId)
        ->where('date', '>=', Carbon::now())
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->get();

        return $appointments;
    }


    //next immediate appointment for doctor
    public static function nextAppointmentForDoctor($doctorId)
    {
        // Retrieve all appointments for the given doctorId that has 'status' as 'pending' or 'rescheduled'
        //$upcomingAppointments = Appointments::where('doctorId', $doctorId)->where('status', 'pending')->orWhere('status', 'rescheduled')->get();


        // Retrieve the next appointment for the given doctorId
        $nextAppointment = Appointments::where('doctorId', $doctorId)
        ->where('date', '>=', Carbon::now())
            ->where('status', 'pending')
            ->orWhere('status', 'rescheduled')
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->first();

        return $nextAppointment;
    }

    //Take patient and retrive the collection of medicalRecords with that patientId
    public static function getFilesForPatient($patientId)
    {
        // Retrieve the medicalRecords for the given patientId
        $medicalRecords = MedicalRecord::where('patientId', $patientId)
        ->get();

        return $medicalRecords;
    }


}
