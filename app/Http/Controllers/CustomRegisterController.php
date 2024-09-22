<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomRegisterController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:doctor,staff,patient'],
            // Additional validation rules for each role can be added here if needed
        ]);

        dd(register($request));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        // Create the user
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);


        // Set extra attributes based on the role
        $user->fill($request->only([
            'firstName',
            'lastName',
            'phone',
            'address',
            'dateOfBirth',
            'specialty',
            'medicalCouncilRegistration',
            'patientId',
            'bloodType',
            'weightKg',
            'heightCm',
            'emergencyContactName',
            'emergencyContactPhone',
            'specialNotes',
            'gender',
        ]));


        // Save the user
        $user->save();

        // Trigger the Registered event
        event(new Registered($user));

        // Log in the user
        $this->guard->login($user);

        // Return the response
        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
