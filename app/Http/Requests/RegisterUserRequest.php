<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust as needed for authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $role = $this->input('role');

        // Handle the validation rules based on the role
        switch ($role) {
            case 'doctor':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                    'role' => 'required|string|in:doctor',
                    'firstName' => 'required|string|max:255',
                    'lastName' => 'required|string|max:255',
                    'phone' => 'required|string|max:20',
                    'address' => 'required|array',
                    'address.street' => 'required|string|max:255',
                    'address.city' => 'required|string|max:255',
                    'address.province' => 'required|string|max:255',
                    'address.postalCode' => 'required|string|max:20',
                    'address.country' => 'required|string|max:255',
                    'dateOfBirth' => 'required|date',
                    'specialty' => 'required|string|max:255',
                    'medicalCouncilRegistration' => 'required|string|max:255|unique:practitioners',
                ];

            case 'patient':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                    'role' => 'required|string|in:patient',
                    'firstName' => 'required|string|max:255',
                    'lastName' => 'required|string|max:255',
                    'phone' => 'required|string|max:20',
                    'address' => 'required|array',
                    'address.street' => 'required|string|max:255',
                    'address.city' => 'required|string|max:255',
                    'address.province' => 'required|string|max:255',
                    'address.postalCode' => 'required|string|max:20',
                    'address.country' => 'required|string|max:255',
                    'dateOfBirth' => 'required|date',
                    'bloodType' => 'required|string|max:10',
                    'weightKg' => 'required|numeric|min:0',
                    'heightCm' => 'required|numeric|min:0',
                    'emergencyContactName' => 'required|string|max:255',
                    'emergencyContactPhone' => 'required|string|max:20',
                    'specialNotes' => 'nullable|string',
                ];

            case 'staff':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                    'role' => 'required|string|in:staff',
                    'firstName' => 'required|string|max:255',
                    'lastName' => 'required|string|max:255',
                    'phone' => 'required|string|max:20',
                    'address' => 'required|array',
                    'address.street' => 'required|string|max:255',
                    'address.city' => 'required|string|max:255',
                    'address.province' => 'required|string|max:255',
                    'address.postalCode' => 'required|string|max:20',
                    'address.country' => 'required|string|max:255',
                    'dateOfBirth' => 'required|date',
                ];

            default:
                // If the role is not valid, abort with a 403 status code
                abort(Response::HTTP_FORBIDDEN, 'Invalid role specified.');
        }
    }
}
