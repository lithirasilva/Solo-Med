<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
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
            'gender' => 'required|string|max:10',
        ];
    }


}
