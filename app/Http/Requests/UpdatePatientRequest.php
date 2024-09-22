<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You might want to implement authorization logic here
        // For now, it returns true for simplicity
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal Information
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],

            // Address Information
            'address.street' => ['required', 'string', 'max:255'],
            'address.city' => ['required', 'string', 'max:255'],
            'address.province' => ['required', 'string', 'max:255'],
            'address.postalCode' => ['required', 'string', 'max:20'],
            'address.country' => ['required', 'string', 'max:255'],

            // Medical Details
            'dateOfBirth' => ['required', 'date'],
            'bloodType' => ['required', 'string', 'max:10'],
            'weightKg' => ['required', 'numeric', 'min:0'],
            'heightCm' => ['required', 'numeric', 'min:0'],

            // Emergency Contact
            'emergencyContactName' => ['required', 'string', 'max:255'],
            'emergencyContactPhone' => ['required', 'string', 'max:20'],

            // Special Notes
            'specialNotes' => ['nullable', 'string'],

            // Gender
            'gender' => ['required', 'in:Male,Female'],
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'firstName.required' => 'First name is required.',
            'lastName.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'phone.required' => 'Phone number is required.',
            'address.street.required' => 'Street address is required.',
            'address.city.required' => 'City is required.',
            'address.province.required' => 'Province is required.',
            'address.postalCode.required' => 'Postal code is required.',
            'address.country.required' => 'Country is required.',
            'dateOfBirth.required' => 'Date of birth is required.',
            'bloodType.required' => 'Blood type is required.',
            'weightKg.required' => 'Weight is required.',
            'heightCm.required' => 'Height is required.',
            'emergencyContactName.required' => 'Emergency contact name is required.',
            'emergencyContactPhone.required' => 'Emergency contact phone is required.',
            'gender.required' => 'Gender is required.',
            'gender.in' => 'Gender must be Male or Female.',
        ];
    }
}
