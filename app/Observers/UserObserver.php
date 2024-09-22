<?php
//
//namespace App\Observers;
//
//use App\Models\User;
//use App\Models\Practitioner;
//use App\Models\ClinicStaff;
//use App\Models\Patient;
//
//class UserObserver
//{
//    public function created(User $user)
//    {
//        dd($user);
//        $attributes = $user->getExtraAttributes();
//
//        if ($user->role === 'doctor') {
//            Practitioner::create([
//                'user_id' => $user->id,
//                'firstName' => $attributes['firstName'] ?? null,
//                'lastName' => $attributes['lastName'] ?? null,
//                'phone' => $attributes['phone'] ?? null,
//                'address' => json_encode($attributes['address'] ?? null), // Convert array to JSON
//                'dateOfBirth' => $attributes['dateOfBirth'] ?? null,
//                'specialty' => $attributes['specialty'] ?? null,
//                'medicalCouncilRegistration' => $attributes['medicalCouncilRegistration'] ?? null,
//            ]);
//        } elseif ($user->role === 'staff') {
//            ClinicStaff::create([
//                'user_id' => $user->id,
//                'firstName' => $attributes['firstName'] ?? null,
//                'lastName' => $attributes['lastName'] ?? null,
//                'phone' => $attributes['phone'] ?? null,
//                'address' => json_encode($attributes['address'] ?? null), // Convert array to JSON
//                'dateOfBirth' => $attributes['dateOfBirth'] ?? null,
//            ]);
//        } elseif ($user->role === 'patient') {
//            $patientId = $user->getExtraAttributes()['patientId'] ?? null;
//
//            if ($patientId) {
//                // Check if patientId exists and email matches
//                $patient = Patient::where('patientId', $patientId)->first();
//
//                if ($patient && $patient->email === $user->email) {
//                    // Update existing patient record with new user_id
//                    $patient->user_id = $user->id;
//                    $patient->save();
//                } else {
//                    // Handle case where patientId does not match or does not exist
//                    Log::error("Invalid patientId or email does not match for user ID {$user->id}");
//                    // Optionally, you could throw an exception or handle it based on your requirements
//                }
//            } else {
//                // Create new Patient record
//                Patient::create([
//                    'user_id' => $user->id,
//                    'firstName' => $user->getExtraAttributes()['firstName'] ?? null,
//                    'lastName' => $user->getExtraAttributes()['lastName'] ?? null,
//                    'email' => $user->email, // Use user email as patient email
//                    'phone' => $user->getExtraAttributes()['phone'] ?? null,
//                    'address' => json_encode($user->getExtraAttributes()['address'] ?? null), // Convert array to JSON
//                    'bloodType' => $user->getExtraAttributes()['bloodType'] ?? null,
//                    'dateOfBirth' => $user->getExtraAttributes()['dateOfBirth'] ?? null,
//                    'weightKg' => $user->getExtraAttributes()['weightKg'] ?? null,
//                    'heightCm' => $user->getExtraAttributes()['heightCm'] ?? null,
//                    'emergencyContactName' => $user->getExtraAttributes()['emergencyContactName'] ?? null,
//                    'emergencyContactPhone' => $user->getExtraAttributes()['emergencyContactPhone'] ?? null,
//                    'specialNotes' => $user->getExtraAttributes()['specialNotes'] ?? null,
//                    'gender' => $user->getExtraAttributes()['gender'] ?? null,
//                    // Add other fields as necessary
//                ]);
//            }
//        }
//    }
//}
