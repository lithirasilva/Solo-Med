<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;


class patientSideLinks extends Controller
{

    public function home()
    {
        return Inertia::render('ClientView/PatientAuthHome');
    }

    public function appointments()
    {
        return Inertia::render('ClientView/PatientAppointments');
    }

    public function newAppointment()
    {
        return Inertia::render('ClientView/PatientNewAppointment');
    }


    public function patientData()
    {
        return Inertia::render('ClientView/PatientData');
    }

}
