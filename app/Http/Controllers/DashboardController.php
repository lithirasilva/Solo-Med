<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Controllers\PatientController;

class DashboardController extends Controller
{
    public function home()
    {
        return Inertia::render('AuthHome');
    }

    public function appointments()
    {
        return Inertia::render('AppointmentsHome');
    }

    public function patients()
    {
        return Inertia::render('PatientsHome');
    }

    public function createPatient()
    {
        return Inertia::render('Dashboard', [
            'tabComponent' => 'CreatePatientForm',
        ]);
    }
    // Add more methods as needed
    public function staff()
    {
        return Inertia::render('Dashboard',[
            'tabComponent'=>'UserManagement'
        ]);
    }

    public function notifications()
    {
        return Inertia::render('NotificationsHome');

    }


    public function finances()
    {
        return Inertia::render('Finances',
        [
            'AppointmentsThisWeek'=>10,
            'AppointmentsThisMonth'=>20,
        ]
        );
    }

    public function settings()
    {
        return Inertia::render('Settings');
    }

    public function example1()
    {
        $patientController = new PatientController(); // Create an instance of PatientController
        $patients = $patientController->index();    // Call the instance method

        return Inertia::render('example1', [
            'name' => 'kumara',
            'age' => 25,
            'patients' => $patients,  // Pass the result of the index method
        ]);
    }
}

