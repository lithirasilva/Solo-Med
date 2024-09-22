<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreMedicalRecordRequest;
use App\Http\Requests\UpdateMedicalRecordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::all();
        return Inertia::render('MedicalRecord/MedicalRecordsIndex', [
            'medicalRecords' => $medicalRecords
        ]);
    }

    public function create()
    {
        return Inertia::render('MedicalRecord/CreateRecord');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'patientId' => 'required',
            'doctorId' => 'required',
            'appointmentId' => 'nullable',
            'recordTitle' => 'required',
            'recordType' => 'required|array',
            'notes' => 'nullable|string',
            'prescription' => 'nullable|string',
            'uploads' => 'nullable|file|max:15360', // 15MB in kilobytes
        ]);

        // Prepare data for creation
        $data = [
            'patientId' => $request->input('patientId'),
            'doctorId' => $request->input('doctorId'),
            'appointmentId' => $request->input('appointmentId'),
            'recordTitle' => $request->input('recordTitle'),
            'recordType' => json_encode($request->input('recordType')),
            'notes' => $request->input('notes'),
            'prescription' => $request->input('prescription'),
        ];

        // Handle file upload
        if ($request->hasFile('uploads')) {
            // Use patientId to store the file in the correct directory
            $patientId = $request->input('patientId');
            $filePath = $request->file('uploads')->store("patient_files/$patientId", 'local');
            $data['uploads'] = $filePath; // Save the file path in uploads field
        }

        // Create the medical record
        $medicalRecord = MedicalRecord::create($data);

        return redirect()->route('medical-records.show', $medicalRecord->medicalRecordId)
            ->with('success', 'Medical record created successfully.');
    }


    public function edit(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['appointment', 'patient', 'doctor']);
        return Inertia::render('MedicalRecords/Edit', [
            'medicalRecord' => $medicalRecord
        ]);
    }

    public function update(UpdateMedicalRecordRequest $request, MedicalRecord $medicalRecord)
    {
        $medicalRecord->update($request->validated());
        return redirect()->route('medical-records.show', $medicalRecord->id)
            ->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        // Check if there is an uploads file path and delete the file if it exists
        if ($medicalRecord->uploads) {
            Storage::delete($medicalRecord->uploads);
        }

        // Delete the medical record
        $medicalRecord->delete();

        return redirect()->route('medical-records.index')
            ->with('success', 'Medical record deleted successfully.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        //with associated doctor/patient/appointment

        $medicalRecord->load(['appointment', 'patient', 'doctor']);

        return Inertia::render('MedicalRecord/MedicalRecordShow', [
            'medicalRecord' => $medicalRecord
        ]);
    }


}
