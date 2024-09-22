<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreAppointmentsRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            'patientId' => 'required|exists:patients,patientId',
            'doctorId' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'startTime' => 'date_format:H:i',
            'endTime' => 'date_format:H:i|after:startTime',
            'status' => 'required|in:pending,rescheduled,cancelled,completed',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'medicalRecordsId' => 'nullable|exists:medical_records,medicalRecordsId',
        ];
    }

    public function persist()
    {
        // Get the average time for an appointment which is 15 mins
        $averageTime = 15;

        // Calculate endTime
        $this->merge([
            'endTime' => Carbon::parse($this->startTime)->addMinutes($averageTime),
        ]);
    }
}
