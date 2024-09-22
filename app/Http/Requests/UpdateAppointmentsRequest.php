<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patientId' => 'required|exists:patients,patientId',
            'date' => 'required|date',
            'startTime' => 'required|string',
            'endTime' => 'required|string',
            'reason' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,rescheduled,cancelled,completed, missed',
        ];
    }

    public function messages()
    {
        return [
            'patientId.required' => 'The patient field is required.',
            'patientId.exists' => 'The selected patient does not exist.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date.',
            'startTime.required' => 'The start time field is required.',
            'endTime.required' => 'The end time field is required.',
            'reason.string' => 'The reason must be a string.',
            'notes.string' => 'The notes must be a string.',
            'status.required' => 'The status field is required.',
        ];
    }
}
