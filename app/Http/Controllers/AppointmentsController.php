<?php

namespace App\Http\Controllers;

use App\Helpers\CalculationsHelper;
use App\Helpers\QueryProvider;
use App\Models\Appointments; // Corrected model reference
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreAppointmentsRequest;
use App\Http\Requests\UpdateAppointmentsRequest;
use Illuminate\Support\Facades\Artisan;

class AppointmentsController extends Controller
{
    public function index()
    {
        $exitCode = Artisan::call('appointments:update-missed');

        //view next immediate appointment
        $nextAppointment = QueryProvider::nextAppointmentForDoctor(QueryProvider::getDoctorId(auth()->user()->id));
        if($nextAppointment){
            $nextAppointment->load(['Patient', 'doctor']);
        };



        // Eager loading the patient and doctor relationships
        $appointments = Appointments::all();
        $appointments->load(['Patient', 'doctor']);

        //dd($appointments);

        return Inertia::render('AppointmentsHome', [
            'appointments' => $appointments,
            'nextAppointment' => $nextAppointment,
        ]);
    }

    public function create()
    {
        // Get the currently logged-in user
        $patients = CalculationsHelper::addFullNameToCollection(Patient::all());


        // Get the current user and the team they belong to
        $currentUser = auth()->user();
        //$currentPractitioner = CalculationsHelper::addFullNameToPerson(Practitioner::where('user_id', $currentUser->id)->first());

        //dd(QueryProvider::getDoctorId($currentUser->id));
        $userId = $currentUser->id;
        $currentDoctor = Practitioner::where('user_id', $userId)->first();

        $takenAppointments =QueryProvider::upcomingAppointmentsForDoctor(QueryProvider::getDoctorId($currentUser->id));


        return Inertia::render('NewAppointment', [
            'patients' => $patients,
            'doctors' => $currentDoctor,
            'takenAppointments' => $takenAppointments,
        ]);

    }



    public function store(StoreAppointmentsRequest $request)
    {
        $request->persist();
        // Creating an appointment and returning to the show route
        $appointment = Appointments::create($request->validated());

        return redirect()->route('appointments.show', $appointment->appointmentId)->with('success', 'Appointment created successfully.');
    }

    public function show(Appointments $appointment)
    {
        // Eager loading patient, doctor, and medical record relationships
        $appointment->load(['Patient', 'doctor', 'medicalRecord']);
        return Inertia::render('ViewFullAppointment',
            ['appointment' => $appointment]
        );
    }

    public function edit(Appointments $appointment)
    {
        // Eager loading patient and doctor relationships
        $appointment->load(['Patient', 'doctor', 'medicalRecord']);
        return Inertia::render('EditAppointment', ['appointment' => $appointment]);
    }

    public function update(UpdateAppointmentsRequest $request, Appointments $appointment)
    {
        $request->validated();
        // Updating the appointment with validated data
        $appointment->update($request->validated());

        return redirect()->route('appointments.show', $appointment->appointmentId)->with('success', 'Appointment updated successfully.');


    }

    public function destroy(Appointments $appointment)
    {
        // Deleting the appointment and redirecting back to the index
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
