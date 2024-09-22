<?php

namespace App\Http\Controllers;

use App\Helpers\CalculationsHelper;
use App\Helpers\QueryProvider;
use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        $patientsResponse = CalculationsHelper::addLastVisitToCollection(CalculationsHelper::addAgeToCollection($patients));
        return Inertia::render('PatientsHome', [
            'patients' => $patientsResponse
        ]);
    }

    public function create()
    {
        return Inertia::render('CreatePatient');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients',
            'phone' => 'required|string|max:20',
            'address.street' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.province' => 'required|string|max:255',
            'address.postalCode' => 'required|string|max:10',
            'address.country' => 'required|string|max:255',
            'dateOfBirth' => 'required|date',
            'bloodType' => 'required|string|max:3',
            'weightKg' => 'required|numeric',
            'heightCm' => 'required|numeric',
            'emergencyContactName' => 'required|string|max:255',
            'emergencyContactPhone' => 'required|string|max:20',
            'specialNotes' => 'nullable|string',
            'gender' => 'required|string|max:10',
        ]);

        $patient = Patient::create($validatedData);


        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }


    public function show(string $patientId)
    {
        $patient = CalculationsHelper::addAgeAndLastVisitToPatient(Patient::where('patientId', $patientId)->first());
        $patientAppointments = QueryProvider::getAppointmentsForPatient($patientId );
        $patientFiles = QueryProvider::getFilesForPatient($patientId);

        return Inertia::render('FullPatientProfile', [
            'patient' => $patient,
            'patientAppointments' => $patientAppointments,
        ]);

    }

    public function edit(Patient $patient)
    {
        return Inertia::render('EditPatient', [
            'patient' => $patient
        ]);
    }

    public function update(Request $request, Patient $patient)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address.street' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.province' => 'required|string|max:255',
            'address.postalCode' => 'required|string|max:20',
            'address.country' => 'required|string|max:255',
            'dateOfBirth' => 'required|date',
            'bloodType' => 'required|string|max:10',
            'weightKg' => 'required|numeric',
            'heightCm' => 'required|numeric',
            'emergencyContactName' => 'required|string|max:255',
            'emergencyContactPhone' => 'required|string|max:20',
            'specialNotes' => 'nullable|string',
        ]);

        // Extract address data separately
        $address = $validated['address'];
        unset($validated['address']);

        // Update only the editable fields
        $patient->update(array_merge($validated, [
            'address' => $address,
        ]));

        // Redirect with a success message
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}
