<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePractitionerRequest extends FormRequest
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
            'user_id' => 'required|exists:users,user_id',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|json',
            'dateOfBirth' => 'required|date',
            'specialty' => 'required|string|max:255',
            'medicalCouncilRegistration' => 'required|string|unique:practitioners,medicalCouncilRegistration',
        ];
    }
}
