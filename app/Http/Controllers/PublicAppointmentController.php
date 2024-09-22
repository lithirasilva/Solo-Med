<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments; // <-- Ensure this import is here
use App\Mail\OtpMail;
use App\Mail\AppointmentConfirmationMail;
use Illuminate\Support\Facades\Mail;

class PublicAppointmentController extends Controller
{
    public function create()
    {
        return inertia('PublicAppointment/Create');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in session
        session(['otp' => $otp, 'appointment_data' => $request->only('name', 'email')]);

        // Send OTP email
        Mail::to($request->email)->send(new OtpMail($otp));

        return inertia('PublicAppointment/VerifyOtp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|integer',
        ]);

        if ($request->otp == session('otp')) {
            return inertia('PublicAppointment/Details');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    public function storeDetails(Request $request)
    {
        $appointmentData = array_merge(session('appointment_data'), $request->only(['date', 'time', 'reason']));

        // Save appointment to database
        $appointment = Appointments::create($appointmentData);

        // Send confirmation email
        Mail::to($appointment->email)->send(new AppointmentConfirmationMail($appointment));

        // Clear session data
        session()->forget(['otp', 'appointment_data']);

        return inertia('PublicAppointment/Success');
    }
}
