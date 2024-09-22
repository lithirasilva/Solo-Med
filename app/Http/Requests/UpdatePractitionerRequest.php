<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePractitionerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Update this logic as per your application's requirements
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstName' => 'sometimes|string|max:255',
            'lastName' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|json',
            'dateOfBirth' => 'sometimes|date',
            'specialty' => 'sometimes|string|max:255',
            'medicalCouncilRegistration' => 'sometimes|string|unique:practitioners,medicalCouncilRegistration,' . $this->practitioner->doctorId,
        ];
    }
}
