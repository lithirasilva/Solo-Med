<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthPatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\patientSideLinks;
use App\Http\Controllers\FileController;

// Public route
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');





// Protected routes with middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
    // Tab routes
    Route::get('/appointments', [DashboardController::class, 'appointments'])->name('dashboard.appointments');
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/clinic-staff',[DashboardController::class,'staff'])->name('dashboard.staff');
    Route::get('/next-appointment', [AppointmentsController::class, 'nextAppointment'])->name('appointments.next-appointment');
    Route::get('/calendar', function (){ return Inertia::render('calendarHome'); })->name('dashboard.calendar');
    Route::get('/notifications', [DashboardController::class, 'notifications'])->name('dashboard.notifications');
    Route::get('/finances',[DashboardController::class,'finances'])->name('dashboard.finances');
    Route::get('/settings',[DashboardController::class,'settings'])->name('dashboard.settings');

    //Resource routes
    Route::resource('appointments', AppointmentsController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('medical-records', MedicalRecordController::class);


    //Route for any other url to display dashboard
    //Route::get('/{any}', [DashboardController::class, 'home'])->where('any', '.*');
});


Route::get('/files/{patientId}/{filename}', [FileController::class, 'show'])->middleware('auth');

// Protected routes without prefix (if needed)

Route::get('/testpage', function () {
    return Inertia::render('TestPage');
})->name('testpage');


//patient routes, must be protected with middleware

Route::middleware(['auth:sanctum', 'verified', config('jetstream.auth_session'),'role:patient'])->group(function () {
    Route::resource('auth-patient', AuthPatientController::class);
});

Route::middleware(['auth:sanctum', 'verified', config('jetstream.auth_session')])->group(function () {
    Route::get('/patient-home', [patientSideLinks::class, 'home'])->name('patient-home');
    Route::get('/patient-appointments', [patientSideLinks::class, 'appointments'])->name('patient-appointments');
    Route::get('/patient-new-appointment', [patientSideLinks::class, 'newAppointment'])->name('patient-new-appointment');
    Route::get('/patient-data', [patientSideLinks::class, 'patientData'])->name('patient-data');

});
